<?php

namespace App\Http\Controllers;

use App\Data\ExpenseGainDto;
use App\Http\Requests\GainExpenseRequest;
use App\Models\BankTemplate;

class BankController extends Controller
{
    public function store(GainExpenseRequest $request)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            BankTemplate::create([
                'data' => new ExpenseGainDto(
                    name: $validated['name'],
                    amount: $validated['amount'],
                ),
                'expense_type_id' => $validated['account_type'],
                'budget_template_id' => auth()->user()->budgetTemplate->id,
            ]);

            return redirect()->route('budget.template.index')
                ->with('success', 'Bank template was created successfully');
        }

        // Banks::create($request->validated());
        return redirect()->back();
    }

    public function update(GainExpenseRequest $request, string $uuid)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            $template = BankTemplate::where('uuid', $uuid)->firstOrFail();
            $template->update([
                'data' => new ExpenseGainDto(
                    name: $validated['name'],
                    amount: $validated['amount'],
                ),
                'expense_type_id' => $validated['account_type'],
            ]);

            return redirect()->route('budget.template.index')
                ->with('success', 'Bank template was updated successfully');
        }

        return redirect()->back();
    }

    public function destroy(string $uuid)
    {
        $template = BankTemplate::where('uuid', $uuid)->first();

        if (empty($template)) {
            // $template = Bank::where('uuid', $uuid)->first();
        }

        $template?->delete();

        return redirect()->back();
    }
}

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
                    amount: convertToCents($validated['amount']),
                ),
                'expense_type_id' => $validated['account_type'],
                'budget_template_id' => auth()->user()->budgetTemplate->id,
            ]);

            return redirect()->route('budget.template.index');
        }

        // Banks::create($request->validated());
        return redirect()->route('budget.template.index');
    }

    public function update(GainExpenseRequest $request, string $uuid)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            $template = BankTemplate::where('uuid', $uuid)->first();
            $template->update([
                'data' => new ExpenseGainDto(
                    name: $validated['name'],
                    amount: convertToCents($validated['amount']),
                ),
                'expense_type_id' => $validated['account_type'],
            ]);

            return redirect()->route('budget.template.index');
        }

        dump($uuid);
        dd($validated);
    }

    public function destroy(string $uuid)
    {
//        $banks->delete();
//
//        return response()->json();
    }
}

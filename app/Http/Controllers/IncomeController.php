<?php

namespace App\Http\Controllers;

use App\Data\IncomeDto;
use App\Http\Requests\GainExpenseRequest;
use App\Models\IncomeTemplate;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function store(GainExpenseRequest $request)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            IncomeTemplate::create([
                'data' => new IncomeDto(
                    name: $validated['name'],
                    amount: $validated['amount'],
                    pay_date: Carbon::parse($validated['pay_date']),
                ),
                'expense_type_id' => $validated['account_type'],
                'budget_template_id' => auth()->user()->budgetTemplate->id,
            ]);

            return redirect()->route('budget.template.index')
                ->with('success', 'Expense was created successfully');
        }

        return redirect()->back();
    }

    public function update(GainExpenseRequest $request, string $uuid)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            $template = IncomeTemplate::where('uuid', $uuid)->firstOrFail();
            $template->update([
                'data' => new IncomeDto(
                    name: $validated['name'],
                    amount: $validated['amount'],
                    pay_date: Carbon::parse($validated['pay_date']),
                ),
                'expense_type_id' => $validated['account_type'],
            ]);

            return redirect()->route('budget.template.index')
                ->with('success', 'Expense was updated successfully');
        }

        return redirect()->back();
    }
}

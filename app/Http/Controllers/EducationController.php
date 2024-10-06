<?php

namespace App\Http\Controllers;

use App\Data\ExpenseSpendDto;
use App\Http\Requests\CommonExpenseRequest;
use App\Models\EducationTemplate;

class EducationController extends Controller
{
    public function store(CommonExpenseRequest $request)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            EducationTemplate::create([
                'data' => new ExpenseSpendDto(
                    name: $validated['name'],
                    amount: $validated['amount'],
                    due_date: $validated['due_date'],
                ),
                'expense_type_id' => $validated['account_type'],
                'budget_template_id' => auth()->user()->budgetTemplate->id,
            ]);

            return redirect()->route('budget.template.index')
                ->with('message', 'Education template was created successfully');
        }

        return redirect()->back();
    }

    public function update(CommonExpenseRequest $request, string $uuid)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            $template = EducationTemplate::where('uuid', $uuid)->firstOrFail();
            $template->update([
                'data' => new ExpenseSpendDto(
                    name: $validated['name'],
                    amount: $validated['amount'],
                    due_date: $validated['due_date'],
                ),
                'expense_type_id' => $validated['account_type'],
            ]);

            return redirect()->route('budget.template.index')
                ->with('message', 'Education template was updated successfully');
        }

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Data\ExpenseSpendDto;
use App\Http\Requests\CommonExpenseRequest;
use App\Services\CommonExpenseService;

class CommonExpenseController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(CommonExpenseRequest $request)
    {
        $validated = $request->validated();

        $this->commonExpenseService->getModel($request, $validated['template'])::create([
            'data' => new ExpenseSpendDto(
                name: $validated['name'],
                amount: $validated['amount'],
                due_date: $validated['due_date'],
            ),
            'expense_type_id' => $validated['account_type'],
            'budget_template_id' => auth()->user()->budgetTemplate->id, // @todo if template, budget_template_id, else, budget_id
        ]);

        return redirect()->back()
            ->with('message', 'Expense was created successfully');
    }

    public function update(CommonExpenseRequest $request, string $uuid)
    {
        $validated = $request->validated();

        $template = $this->commonExpenseService->getModel($request, $validated['template'])::query()
            ->where('uuid', $uuid)->firstOrFail();

        $template->update([
            'data' => new ExpenseSpendDto(
                name: $validated['name'],
                amount: $validated['amount'],
                due_date: $validated['due_date'],
            ),
            'expense_type_id' => $validated['account_type'],
        ]);

        return redirect()->back()
            ->with('message', 'Expense was updated successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Data\ExpenseSpendDto;
use App\Http\Requests\CommonExpenseRequest;
use App\Services\CommonExpenseService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommonExpenseController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(CommonExpenseRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->commonExpenseService->getModelByRequest($request, $validated['template'])::create([
            'data' => new ExpenseSpendDto(
                name: $validated['name'],
                amount: $validated['amount'],
                due_date: $validated['due_date'] ?? null,
                confirmation: $validated['confirmation'] ?? null,
                paid_date: ! empty($validated['paid_date']) ? Carbon::parse($validated['paid_date']) : null,
                notes: $validated['notes'] ?? null,
            ),
            'expense_type_id' => $validated['account_type'],
            ...$this->commonExpenseService->getBudgetRelationship($request, $validated['template']),
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was created successfully');
    }

    public function update(CommonExpenseRequest $request, string $uuid): RedirectResponse
    {
        $validated = $request->validated();

        $template = $this->commonExpenseService->getModelByRequest($request, $validated['template'])::query()
            ->withBudget()
            ->where('uuid', $uuid)
            ->firstOrFail();

        $template->update([
            'data' => new ExpenseSpendDto(
                name: $validated['name'],
                amount: $validated['amount'],
                due_date: $validated['due_date'] ?? null,
                confirmation: $validated['confirmation'] ?? null,
                paid_date: ! empty($validated['paid_date']) ? Carbon::parse($validated['paid_date']) : null,
                notes: $validated['notes'] ?? null,
            ),
            'expense_type_id' => $validated['account_type'],
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was updated successfully');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'uuid'],
            'template' => ['required', 'bool'],
        ]);

        $expense = $this->commonExpenseService->getModelByRequest($request, $validated['template'])::query()
            ->where('uuid', $validated['id'])
            ->first();

        if (! empty($expense)) {
            $expense->delete();
        }

        return redirect()->back()
            ->with('message', $expense->data->name . ' was deleted successfully');
    }
}

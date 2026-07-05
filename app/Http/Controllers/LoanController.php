<?php

namespace App\Http\Controllers;

use App\Data\LoanDto;
use App\Http\Requests\LoanRequest;
use App\Services\CommonExpenseService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(LoanRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->commonExpenseService->getModelByRequest($request, $validated['template'])::create([
            'data' => $this->getLoanDto($validated),
            'expense_type_id' => $validated['account_type'],
            ...$this->commonExpenseService->getBudgetRelationship($request, $validated['template']),
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was created successfully');
    }

    public function update(LoanRequest $request, string $uuid): RedirectResponse
    {
        $validated = $request->validated();

        $template = $this->commonExpenseService->getModelByRequest($request, $validated['template'])::query()
            ->withBudget()
            ->where('uuid', $uuid)
            ->firstOrFail();

        $template->update([
            'data' => $this->getLoanDto($validated),
            'expense_type_id' => $validated['account_type'],
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was updated successfully');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $name = $this->commonExpenseService->deleteExpense($request);

        return redirect()->back()
            ->with('message', $name . ' was deleted successfully');
    }

    /**
     * @param mixed $validated
     * @return LoanDto
     */
    public function getLoanDto(mixed $validated): LoanDto
    {
        return new LoanDto(
            name: $validated['name'],
            amount: $validated['amount'],
            due_date: $validated['due_date'] ?? 1,
            apr: $validated['apr'] ?? null,
            balance: $validated['balance'] ?? null,
            limit: $validated['limit'] ?? null,
            confirmation: $validated['confirmation'] ?? null,
            notes: $validated['notes'] ?? null,
            paid_date: !empty($validated['paid_date']) ? Carbon::parse($validated['paid_date']) : null,
        );
    }
}

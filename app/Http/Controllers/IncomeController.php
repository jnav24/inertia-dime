<?php

namespace App\Http\Controllers;

use App\Data\IncomeDto;
use App\Http\Requests\GainExpenseRequest;
use App\Services\CommonExpenseService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(GainExpenseRequest $request): RedirectResponse
    {
        /** @var array{name: string, amount: float, pay_date: string, template: bool, account_type: string} $validated */
        $validated = $request->validated();

        $this->commonExpenseService->getModelByRequest($request, $validated['template'])::create([
            'data' => new IncomeDto(
                name: $validated['name'],
                amount: $validated['amount'],
                pay_date: Carbon::parse($validated['pay_date']),
            ),
            'expense_type_id' => $validated['account_type'],
            ...$this->commonExpenseService->getBudgetRelationship($request, $validated['template']),
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was created successfully');
    }

    public function update(GainExpenseRequest $request, string $uuid): RedirectResponse
    {
        $validated = $request->validated();

        $template = $this->commonExpenseService->getModelByRequest($request, $validated['template'])::query()
            ->withBudget()
            ->where('uuid', $uuid)
            ->firstOrFail();

        $template->update([
            'data' => new IncomeDto(
                name: $validated['name'],
                amount: $validated['amount'],
                pay_date: Carbon::parse($validated['pay_date']),
            ),
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
}

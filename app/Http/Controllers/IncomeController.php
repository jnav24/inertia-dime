<?php

namespace App\Http\Controllers;

use App\Data\IncomeDto;
use App\Http\Requests\GainExpenseRequest;
use App\Services\CommonExpenseService;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(GainExpenseRequest $request)
    {
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

    public function update(GainExpenseRequest $request, string $uuid)
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
}

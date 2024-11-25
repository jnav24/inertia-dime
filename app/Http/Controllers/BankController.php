<?php

namespace App\Http\Controllers;

use App\Data\ExpenseGainDto;
use App\Http\Requests\GainExpenseRequest;
use App\Models\BankTemplate;
use App\Services\CommonExpenseService;

class BankController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(GainExpenseRequest $request)
    {
        $validated = $request->validated();

        $this->commonExpenseService->getModelByRequest($request, $validated['template'])::create([
            'data' => new ExpenseGainDto(
                name: $validated['name'],
                amount: $validated['amount'],
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
            'data' => new ExpenseGainDto(
                name: $validated['name'],
                amount: $validated['amount'],
            ),
            'expense_type_id' => $validated['account_type'],
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was updated successfully');
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

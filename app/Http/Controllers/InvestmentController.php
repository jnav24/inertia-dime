<?php

namespace App\Http\Controllers;

use App\Data\ExpenseGainDto;
use App\Http\Requests\GainExpenseRequest;
use App\Models\Banks;
use App\Models\InvestmentTemplate;
use App\Services\CommonExpenseService;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(GainExpenseRequest $request)
    {
        $validated = $request->validated();

        $this->commonExpenseService->getModel($request, $validated['template'])::create([
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

        $template = $this->commonExpenseService->getModel($request, $validated['template'])::query()
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
//        $banks->delete();
//
//        return response()->json();
    }
}

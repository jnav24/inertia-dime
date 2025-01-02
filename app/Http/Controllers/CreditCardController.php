<?php

namespace App\Http\Controllers;

use App\Data\CreditCardDto;
use App\Http\Requests\CreditCardRequest;
use App\Models\CreditCardTemplate;
use App\Services\CommonExpenseService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class CreditCardController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(CreditCardRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->commonExpenseService->getModelByRequest($request, $validated['template'])::create([
            'data' => new CreditCardDto(
                name: $validated['name'],
                amount: $validated['amount'],
                due_date: $validated['due_date'] ?? 1,
                apr: $validated['apr'] ?? null,
                balance: $validated['balance'] ?? null,
                exp_month: $validated['exp_month'] ?? null,
                exp_year: $validated['exp_year'] ?? null,
                last_4: $validated['last_4'] ?? null,
                limit: $validated['limit'] ?? null,
                confirmation: $validated['confirmation'] ?? null,
                notes: $validated['notes'] ?? null,
                paid_date: ! empty($validated['paid_date']) ? Carbon::parse($validated['paid_date']) : null,
            ),
            'expense_type_id' => $validated['account_type'],
            ...$this->commonExpenseService->getBudgetRelationship($request, $validated['template']),
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was created successfully');
    }

    public function update(CreditCardRequest $request, string $uuid): RedirectResponse
    {
        $validated = $request->validated();

        $template = $this->commonExpenseService->getModelByRequest($request, $validated['template'])::query()
            ->withBudget()
            ->where('uuid', $uuid)
            ->firstOrFail();

        $template->update([
            'data' => new CreditCardDto(
                name: $validated['name'],
                amount: $validated['amount'],
                due_date: $validated['due_date'] ?? 1,
                apr: $validated['apr'] ?? null,
                balance: $validated['balance'] ?? null,
                exp_month: $validated['exp_month'] ?? null,
                exp_year: $validated['exp_year'] ?? null,
                last_4: $validated['last_4'] ?? null,
                limit: $validated['limit'] ?? null,
                confirmation: $validated['confirmation'] ?? null,
                notes: $validated['notes'] ?? null,
                paid_date: ! empty($validated['paid_date']) ? Carbon::parse($validated['paid_date']) : null,
            ),
            'expense_type_id' => $validated['account_type'],
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was updated successfully');
    }
}

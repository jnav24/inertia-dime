<?php

namespace App\Http\Controllers;

use App\Data\CreditCardDto;
use App\Http\Requests\CreditCardRequest;
use App\Models\CreditCardTemplate;

class CreditCardController extends Controller
{
    public function store(CreditCardRequest $request)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            CreditCardTemplate::create([
                'data' => new CreditCardDto(
                    name: $validated['name'],
                    amount: $validated['amount'],
                    due_date: $validated['due_date'],
                    apr: $validated['apr'] ?? null,
                    balance: $validated['balance'] ?? null,
                    exp_month: $validated['exp_month'] ?? null,
                    exp_year: $validated['exp_year'] ?? null,
                    last_4: $validated['last_4'] ?? null,
                    limit: $validated['limit'] ?? null,
                ),
                'expense_type_id' => $validated['account_type'],
                'budget_template_id' => auth()->user()->budgetTemplate->id,
            ]);

            return redirect()->route('budget.template.index');
        }

        return redirect()->back();
    }

    public function update(CreditCardRequest $request, string $uuid)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            $template = CreditCardTemplate::where('uuid', $uuid)->firstOrFail();
            $template->update([
                'data' => new CreditCardDto(
                    name: $validated['name'],
                    amount: $validated['amount'],
                    due_date: $validated['due_date'],
                    apr: $validated['apr'] ?? null,
                    balance: $validated['balance'] ?? null,
                    exp_month: $validated['exp_month'] ?? null,
                    exp_year: $validated['exp_year'] ?? null,
                    last_4: $validated['last_4'] ?? null,
                    limit: $validated['limit'] ?? null,
                ),
                'expense_type_id' => $validated['account_type'],
            ]);

            return redirect()->route('budget.template.index');
        }

        return redirect()->back();
    }
}

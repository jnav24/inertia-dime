<?php

namespace App\Http\Controllers;

use App\Data\ExpenseGainDto;
use App\Http\Requests\GainExpenseRequest;
use App\Models\Banks;
use App\Models\BankTemplate;

class BankController extends Controller
{
    public function store(GainExpenseRequest $request)
    {
        $validated = $request->validated();

        if ($validated['is_template']) {
            BankTemplate::create([
                'data' => new ExpenseGainDto(
                    name: $validated['name'],
                    amount: convertToCents($validated['amount']),
                ),
                'expense_type_id' => $validated['account_type'],
            ]);

            return redirect()->route('budget.template.index');
        }

        // Banks::create($request->validated());
        return redirect()->route('budget.template.index');
    }

    public function update(GainExpenseRequest $request, string $uuid)
    {
        $validated = $request->validated();

        if ($validated['template']) {
            $template = BankTemplate::where('uuid', $uuid)->first();
            $template->update([
                'data' => new ExpenseGainDto(
                    name: $validated['name'],
                    amount: convertToCents($validated['amount']),
                ),
                'expense_type_id' => $validated['account_type'],
            ]);

            return redirect()->route('budget.template.index');
        }

        dump($uuid);
        dd($validated);
        $banks->update($request->validated());

        return $banks;
    }

    public function destroy(Banks $banks)
    {
        $banks->delete();

        return response()->json();
    }
}

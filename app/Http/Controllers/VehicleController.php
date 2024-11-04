<?php

namespace App\Http\Controllers;

use App\Data\VehicleDto;
use App\Http\Requests\VehicleExpenseRequest;
use App\Models\VehicleTemplate;

class VehicleController extends Controller
{
    public function store(VehicleExpenseRequest $request)
    {
        $validated = $request->validated();
        $model = $validated['template'] ? VehicleTemplate::class : null;

        $model::create([
            'data' => new VehicleDto(
                amount: $validated['amount'],
                balance: $validated['balance'],
                due_date: $validated['due_date'],
                mileage: $validated['mileage'] ?? null,
                confirmation: $validated['confirmation'] ?? null,
                notes: $validated['notes'] ?? null,
                paid_date: $validated['paid_date'] ?? null,
            ),
            // @todo for this and all others, may have to pass this id in the request
            'budget_template_id' => auth()->user()->budgetTemplate->id,
            'expense_type_id' => $validated['account_type'],
            'user_vehicle_id' => $validated['vehicle'],
        ]);

        return redirect()->back()
            ->with('message', 'Vehicle was created successfully');
    }

    public function update(VehicleExpenseRequest $request, string $uuid)
    {
        $validated = $request->validated();
        $model = $validated['template'] ? VehicleTemplate::class : null;

        $model->update([
            'data' => new VehicleDto(
                amount: $validated['amount'],
                balance: $validated['balance'],
                due_date: $validated['due_date'],
                mileage: $validated['mileage'],
                confirmation: $validated['confirmation'],
                notes: $validated['notes'],
                paid_date: $validated['paid_date'],
            ),
            // @todo for this and all others, may have to pass this id in the request
            'budget_template_id' => auth()->user()->budgetTemplate->id,
            'expense_type_id' => $validated['account_type'],
            'user_vehicle_id' => $validated['vehicle'],
        ]);

        return redirect()->back()
            ->with('message', 'Vehicle was created successfully');
    }

    public function destroy(string $uuid)
    {
    }
}

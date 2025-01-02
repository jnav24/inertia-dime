<?php

namespace App\Http\Controllers;

use App\Data\VehicleDto;
use App\Http\Requests\VehicleExpenseRequest;
use App\Models\VehicleTemplate;
use App\Services\CommonExpenseService;

class VehicleController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function store(VehicleExpenseRequest $request)
    {
        $validated = $request->validated();

        $this->commonExpenseService->getModelByRequest($request, $validated['template'])::create([
            'data' => new VehicleDto(
                amount: $validated['amount'],
                balance: $validated['balance'],
                due_date: $validated['due_date'],
                mileage: $validated['mileage'] ?? null,
                confirmation: $validated['confirmation'] ?? null,
                notes: $validated['notes'] ?? null,
                paid_date: $validated['paid_date'] ?? null,
            ),
            'expense_type_id' => $validated['account_type'],
            'user_vehicle_id' => $validated['vehicle'],
            ...$this->commonExpenseService->getBudgetRelationship($request, $validated['template']),
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was created successfully');
    }

    public function update(VehicleExpenseRequest $request, string $uuid)
    {
        $validated = $request->validated();

        $template = $this->commonExpenseService->getModelByRequest($request, $validated['template'])::query()
            ->withBudget()
            ->where('uuid', $uuid)
            ->firstOrFail();

        $template->update([
            'data' => new VehicleDto(
                amount: $validated['amount'],
                balance: $validated['balance'],
                due_date: $validated['due_date'],
                mileage: $validated['mileage'],
                confirmation: $validated['confirmation'] ?? null,
                notes: $validated['notes'] ?? null,
                paid_date: $validated['paid_date'] ?? null,
            ),
            'expense_type_id' => $validated['account_type'],
            'user_vehicle_id' => $validated['vehicle'],
        ]);

        return redirect()->back()
            ->with('message', $validated['name'] . ' was created successfully');
    }

    public function destroy(string $uuid)
    {
    }
}

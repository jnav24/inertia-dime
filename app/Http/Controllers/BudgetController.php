<?php

namespace App\Http\Controllers;

use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BudgetController extends Controller
{
    public function index()
    {
        // BudgetResource::collection(Budget::all())
        return Inertia::render('Budget', [
            'budgets' => [],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'budget_cycle' => ['required'],
            'user_id' => ['required', 'exists:users'],
            'uuid' => ['required'],
        ]);

        return new BudgetResource(Budget::create($data));
    }

    public function show(Budget $budget)
    {
        return new BudgetResource($budget);
    }

    public function update(Request $request, Budget $budget)
    {
        $data = $request->validate([
            'name' => ['required'],
            'budget_cycle' => ['required'],
            'user_id' => ['required', 'exists:users'],
            'uuid' => ['required'],
        ]);

        $budget->update($data);

        return new BudgetResource($budget);
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return response()->json();
    }
}

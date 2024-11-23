<?php

namespace App\Http\Controllers;

use App\Http\Resources\BudgetAggregationResource;
use App\Http\Resources\BudgetResource;
use App\Http\Resources\ExpenseTypeResource;
use App\Models\Budget;
use App\Models\BudgetAggregation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = auth()
            ->user()
            ->budgets()
            ->with('aggregation')
            ->get();

        $aggregations = $budgets
            ->map(fn (Budget $budget) => new BudgetAggregationResource($budget))
            ->groupBy(fn ($aggregation) => Carbon::parse($aggregation["budget_cycle"])->format("Y"))
            ->map(function ($group) {
                return $group->keyBy(fn ($agg) => Carbon::parse($agg["budget_cycle"])->format("n"));
            });

        return Inertia::render('Budget', [
            'aggregations' => $aggregations,
            'budgets' => BudgetResource::collection($budgets),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => ['required', 'numeric', 'max:12'],
            'year' => ['required', 'digits:4'],
        ]);

        // @todo get budget template data
        // @todo create budget data based off budget template

        $budget = auth()->user()->budgets()->create([
            'budget_cycle' => Carbon::create((int) $validated['year'], (int) $validated['month']),
        ]);


        return redirect()
            ->route('budget.show', ['uuid' => $budget->uuid]);
    }

    public function show(string $uuid)
    {
        $budget = auth()->user()->budgets()->withExpenses()->where('uuid', $uuid)->firstOrFail();
        return Inertia::render('BudgetShow', [
            'budget' => new BudgetResource($budget),
            'types' => ExpenseType::grouped()->map(fn ($object) => ExpenseTypeResource::collection($object)),
        ]);
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

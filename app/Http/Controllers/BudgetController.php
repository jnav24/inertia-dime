<?php

namespace App\Http\Controllers;

use App\Http\Resources\BudgetResource;
use App\Models\Budget;
use App\Models\BudgetAggregation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BudgetController extends Controller
{
    public function index()
    {
        $aggregations = auth()
            ->user()
            ->aggregations()
            ->get()
            ->groupBy(
                fn (BudgetAggregation $aggregation) => Carbon::parse($aggregation->budget_cycle)->format('Y')
            )
            ->sortKeys();

        $budgets = auth()
            ->user()
            ->budgets()
            ->get();

        return Inertia::render('Budget', [
            'aggregations' => [
                '2024' => [
                    '10' => [
                        'earned' => '',
                        'saved' => '',
                        'spent' => '',
                    ],
                ],
            ],
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
        $budget = auth()->user()->budgets()->where('uuid', $uuid)->firstOrFail();
        return Inertia::render('BudgetShow', [
            'budget' => new BudgetResource($budget),
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

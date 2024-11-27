<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseTypeResource;
use App\Http\Resources\ReportResource;
use App\Http\Resources\TemplateResource;
use App\Models\Budget;
use App\Models\ExpenseType;
use App\Services\CommonExpenseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function index(Request $request)
    {
        $aggregations = Budget::query()
            ->selectRaw('YEAR(budget_cycle) as year')
            ->distinct()
            ->orderBy('year')
            ->where('user_id', 1)
            ->get()
            ->map(function ($item) {
                $year = Carbon::parse($item->budget_cycle)->format('Y');
                return ['label' => $year, 'value' => $year];
            });
        $results = [];

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'expense' => ['required'],
                'year' => ['required', 'digits:4'],
                'type' => ['required', 'uuid'],
                'keywords' => ['nullable', 'string'],
            ]);

            $results = Budget::query()
                ->with([
                    $validated['expense'] => fn ($q) => $q->where('expense_type_id', $validated['type']),
                ])
                ->where('user_id', auth()->user()->id)
                ->where('budget_cycle', 'LIKE', $validated['year'] . '%')
                ->get()
                ->map(function (Budget $budget) use ($validated) {
                    return $budget->{$validated['expense']}->map(function ($ex) use ($budget) {
                        $ex->budget_cycle = $budget->budget_cycle;
                        return new ReportResource($ex);
                    });
                })
                ->flatten()
                ->groupBy(
                    fn($report) => Carbon::parse($report["budget_cycle"])->format("M")
                );
        }

        return Inertia::render('Report', [
            'aggregations' => $aggregations,
            'types' => ExpenseType::grouped()->map(fn ($object) => ExpenseTypeResource::collection($object)),
            'results' => $results,
        ]);
    }
}

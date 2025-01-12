<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseTypeResource;
use App\Http\Resources\ReportResource;
use App\Models\Budget;
use App\Models\ExpenseType;
use App\Models\User;
use App\Services\CommonExpenseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function index(Request $request): Response
    {
        /** @var User $user */
        $user = auth()->user();

        $aggregations = Budget::query()
            ->selectRaw("YEAR(budget_cycle) as year")
            ->distinct()
            ->orderByDesc("year")
            ->where("user_id", $user->id)
            ->get()
            ->map(function (Budget $item) {
                return ["label" => $item->year, "value" => $item->year];
            });
        $results = [];

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'expense' => ['required'],
                'year' => ['required', 'digits:4'],
                'type' => ['nullable', 'uuid'],
                'keywords' => ['nullable', 'string'],
            ]);

            $results = Budget::query()
                ->with([
                    $validated['expense'] => fn ($q) => ! empty($validated['types']) ? $q->where('expense_type_id', $validated['type']) : $q,
                ])
                ->where('user_id', $user->id)
                ->where('budget_cycle', 'LIKE', $validated['year'] . '%')
                ->get()
                ->map(function (Budget $budget) use ($validated) {
                    return $budget->{$validated['expense']}
                        ->filter(function ($ex) use ($budget, $validated) {
                            return empty($validated['keywords']) ||
                                str_contains(strtolower($ex->data?->name), strtolower($validated['keywords']));
                        })
                        ->map(function ($ex) use ($budget) {
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

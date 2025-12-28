<?php

namespace App\Http\Controllers;

use App\Http\Resources\BudgetAggregationResource;
use App\Http\Resources\BudgetResource;
use App\Http\Resources\ExpenseTypeResource;
use App\Http\Resources\UserVehicleResource;
use App\Models\Budget;
use App\Models\BudgetTemplate;
use App\Models\ExpenseType;
use App\Models\User;
use App\Services\CommonExpenseService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BudgetController extends Controller
{
    public function __construct(protected CommonExpenseService $commonExpenseService)
    {}

    public function index(): Response
    {
        /** @var User $user */
        $user = auth()->user();

        $budgets = $user
            ->budgets()
            ->with('aggregation')
            ->latest('budget_cycle')
            ->get();

        $aggregations = $budgets
            ->mapInto(BudgetAggregationResource::class)
            ->groupBy(fn ($aggregation) => (string) Carbon::parse($aggregation["budget_cycle"])->year)
            ->map(fn ($group) => $group->keyBy(fn ($agg) => (string) Carbon::parse($agg['budget_cycle'])->month));

        return Inertia::render('Budget', [
            'aggregations' => $aggregations,
            'budgets' => $budgets
                ->mapInto(BudgetResource::class)
                ->groupBy(fn ($budget) => (string) Carbon::parse($budget["budget_cycle"])->year),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'month' => ['required', 'numeric', 'max:12'],
            'year' => ['required', 'digits:4'],
        ]);

        /** @var User $user */
        $user = auth()->user();

        /** @var BudgetTemplate $template */
        $template = $user->budgetTemplate()->withExpenses()->first();

        $budget = $this->commonExpenseService->saveExpenses($template, $validated);
        $this->commonExpenseService->saveAggregations($budget, $template);

        return redirect()
            ->route('budget.show', ['uuid' => $budget->uuid]);
    }

    public function show(string $uuid): Response
    {
        /** @var User $user */
        $user = auth()->user();

        $budget = $user->budgets()->with('aggregation')->withExpenses()->where('uuid', $uuid)->firstOrFail();

        return Inertia::render('BudgetShow', [
            'budget' => new BudgetResource($budget),
            'types' => ExpenseType::grouped()->map(fn ($object) => ExpenseTypeResource::collection($object)),
            'vehicles' => UserVehicleResource::collection(
                $user->userVehicles()->get(),
            ),
            'unpaid' => $this->commonExpenseService->getUnPaid($budget),
        ]);
    }

    public function update(Request $request, Budget $budget): BudgetResource
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

    public function destroy(Budget $budget): JsonResponse
    {
        $budget->delete();

        return response()->json();
    }
}

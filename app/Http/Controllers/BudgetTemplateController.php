<?php

namespace App\Http\Controllers;

use App\Enums\ExpenseTypeEnum;
use App\Http\Resources\BudgetTemplateResource;
use App\Http\Resources\ExpenseTypeResource;
use App\Models\BudgetTemplate;
use App\Models\ExpenseType;
use App\Traits\ExpenseTypes;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BudgetTemplateController extends Controller
{
    use ExpenseTypes;

    public function index()
    {
        $template = auth()->user()->budgetTemplate()->withExpenses()->first();
        return Inertia::render('BudgetTemplate', [
            'budgetTemplate' => new BudgetTemplateResource($template),
            'expenses' => ExpenseTypeEnum::cases(),
            'types' => ExpenseType::grouped()->map(fn ($object) => ExpenseTypeResource::collection($object)),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'uuid' => ['required'],
            'user_id' => ['required', 'exists:users'],
        ]);

        return new BudgetTemplateResource(BudgetTemplate::create($data));
    }

    public function show(BudgetTemplate $budgetTemplate)
    {
        return new BudgetTemplateResource($budgetTemplate);
    }

    public function update(Request $request, BudgetTemplate $budgetTemplate)
    {
        $data = $request->validate([
            'uuid' => ['required'],
            'user_id' => ['required', 'exists:users'],
        ]);

        $budgetTemplate->update($data);

        return new BudgetTemplateResource($budgetTemplate);
    }

    public function destroy(BudgetTemplate $budgetTemplate)
    {
        $budgetTemplate->delete();

        return response()->json();
    }
}

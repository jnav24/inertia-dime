<?php

namespace App\Http\Controllers;

use App\Http\Resources\BudgetTemplateResource;
use App\Models\BudgetTemplate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BudgetTemplateController extends Controller
{
    public function index()
    {
        // return BudgetTemplateResource::collection(BudgetTemplate::all());
        return Inertia::render('BudgetTemplate', []);
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

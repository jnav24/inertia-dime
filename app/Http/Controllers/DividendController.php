<?php

namespace App\Http\Controllers;

use App\Services\BrokerageService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DividendController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Dividend', [
            'items' => [],
        ]);
    }

    public function searchStocks(Request $request, BrokerageService $brokerageService)
    {
        $validated = $request->validate([
            'search' => 'required',
        ]);

        $dividend = $brokerageService->getDividendOrCreate($validated['search']);

        return Inertia::render('Dividend', [
            'items' => collect([$dividend])->flatten()->filter()->values(),
        ]);
    }
}

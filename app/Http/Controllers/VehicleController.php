<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validated();

        if ($validated['template']) {}

        return redirect()->back()
            ->with('message', 'Vehicle was created successfully');
    }

    public function update(Request $request, string $uuid)
    {
        $validated = $request->validated();

        if ($validated['template']) {}

        return redirect()->back()
            ->with('message', 'Vehicle was created successfully');
    }

    public function destroy(string $uuid)
    {
    }
}

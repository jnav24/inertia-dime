<?php

namespace App\Http\Controllers;

use App\Data\UserVehicleDto;
use App\Http\Requests\UserVehicleRequest;
use App\Models\UserVehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserVehicleController extends Controller
{
    public function store(UserVehicleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        UserVehicle::create([
            'user_id' => auth()->user()->id,
            'data' => new UserVehicleDto(
                color: $validated['color'],
                make: $validated['make'],
                model: $validated['model'],
                year: $validated['year'],
                license: $validated['license'],
            ),
        ]);

        return redirect()->back()
            ->with('message', 'Vehicle was created successfully');
    }

    public function update(UserVehicleRequest $request, string $uuid): RedirectResponse
    {
        $validated = $request->validated();
        $userVehicle = UserVehicle::query()
            ->where('uuid', $uuid)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail();

        $userVehicle->update([
            'data' => new UserVehicleDto(
                color: $validated['color'],
                make: $validated['make'],
                model: $validated['model'],
                year: $validated['year'],
                license: $validated['license'],
            ),
        ]);

        return redirect()->back()
            ->with('message', 'Vehicle was updated successfully');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'uuid'],
        ]);

        $userVehicle = UserVehicle::query()
            ->where('uuid', $validated['id'])
            ->where('user_id', auth()->user()->id)
            ->first();

        if (! empty($userVehicle)) {
            $userVehicle->delete();
        }

        return redirect()->back()
            ->with('message', 'Vehicle was deleted successfully');
    }
}

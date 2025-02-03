<?php

namespace App\Http\Controllers;

use App\Enums\CacheEnum;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserVehicleResource;
use App\Models\User;
use App\Models\UserVehicle;
use App\Services\MfaService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, MfaService $mfaService): Response
    {
        $mfa = null;

        $key = CacheEnum::DISPLAY_MFA->value;

        /** @var User $user */
        $user = auth()->user();

        if (! empty(cache($key)) && ! empty($user->mfa_recovery_codes) && ! empty($user->mfa_secret)) {
            /** @var string $recovery */
            $recovery = decrypt($user->mfa_recovery_codes);

            /** @var string $appName */
            $appName = config('app.name');

            /** @var string $secret */
            $secret = decrypt($user->mfa_secret);

            $mfa = [
                'qr_code' => $mfaService->generateQrCodeSvg(
                    $appName,
                    $user->email,
                    $secret,
                ),
                'recovery_codes' => json_decode($recovery),
            ];
        }

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'vehicles' => UserVehicleResource::collection(
                UserVehicle::query()
                    ->where('user_id', $user->id)
                    ->withTrashed()
                    ->get()
            ),
            'hasMfa' => ! empty(auth()->user()->mfa_secret),
            'mfa' => $mfa,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()?->fill($request->validated());

        if ($request->user()?->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()?->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user?->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

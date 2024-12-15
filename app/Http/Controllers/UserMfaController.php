<?php

namespace App\Http\Controllers;

use App\Services\MfaService;
use App\Services\RecoveryCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;

class UserMfaController extends Controller
{
    /**
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws SecretKeyTooShortException
     * @throws InvalidCharactersException
     */
    public function store(RecoveryCodeService $recoveryCodeService, MfaService $mfaService): RedirectResponse
    {
        auth()->user()?->forceFill([
            'mfa_secret' => encrypt($mfaService->generateSecretKey()),
            'mfa_recovery_codes' => encrypt(
                json_encode(
                    Collection::times(8, fn () => $recoveryCodeService->generate())->all(),
                ),
            ),
        ])?->save();

        /** @var string $key */
        $key = config('session.mfa');

        /** @var string $displayKey */
        $displayKey = config('session.display_mfa');

        session()->put($key, auth()->user()?->id);
        session()->put($displayKey, true);

        return redirect()->back();
    }

    public function destroy(): RedirectResponse
    {
        auth()->user()?->forceFill([
            'mfa_secret' => null,
            'mfa_recovery_codes' => null,
        ])?->save();

        /** @var string $key */
        $key = config('session.mfa');

        session()->forget($key);

        return redirect()->back();
    }

    public function verify(Request $request, MfaService $mfaService): JsonResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'numeric', 'digits:6'],
        ]);

        $user = auth()->user();

        if (empty($user) || empty($user->mfa_secret)) {
            return response()->json(['success' => false]);
        }

        /** @var string $secret */
        $secret = decrypt($user->mfa_secret);

        if (! $mfaService->verify($secret, $validated['code'])) {
            return response()->json([
                'errors' => ['code' => 'The provided code was invalid'],
                'success' => false,
            ], 422);
        }

        /** @var string $key */
        $key = config('session.mfa');

        session()->put($key, $user->id);

        return response()->json(['success' => true]);
    }
}

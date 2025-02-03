<?php

namespace App\Http\Controllers;

use App\Enums\CacheEnum;
use App\Services\MfaService;
use App\Services\RecoveryCodeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
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

        Cache::put(CacheEnum::DISPLAY_MFA->value, true);

        return redirect()->back();
    }

    public function destroy(): RedirectResponse
    {
        $this->destroyMFA();

        return redirect()->back();
    }

    public function destroyAPI(): JsonResponse
    {
        $this->destroyMFA();

        return response()->json(['success' => true]);
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

        return response()->json(['success' => true]);
    }

    private function destroyMFA(): void
    {
        auth()->user()?->forceFill([
            'mfa_secret' => null,
            'mfa_recovery_codes' => null,
        ])?->save();

        /** @var string $key */
        $key = config('session.mfa');

        cache()->forget(CacheEnum::DISPLAY_MFA->value);
        session()->forget($key);
    }
}

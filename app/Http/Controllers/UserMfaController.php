<?php

namespace App\Http\Controllers;

use App\Services\MfaService;
use App\Services\RecoveryCodeService;
use Illuminate\Http\RedirectResponse;
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

        session()->put($key, auth()->user()?->id);

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
}

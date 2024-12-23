<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\MfaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VerifyMfaController extends Controller
{
    public function __construct(protected MfaService $mfaService)
    {}

    public function index(Request $request): Response | RedirectResponse
    {
        $errors = [];

        if ($request->method() === 'POST') {
            $validated = $request->validate([
                'code' => ['required', 'numeric', 'digits:6']
            ]);

            /** @var string $key */
            $key = config('session.mfa');

            /** @var string $secret */
            $secret = decrypt(auth()->user()?->mfa_secret ?? '');

            if ($this->mfaService->verify($secret, $validated['code']) && session()->has($key)) {
                /** @var string $session */
                $session = session()->get($key);

                /** @var array<string, bool|int> $sessionArray */
                $sessionArray = decrypt($session);

                session()->put($key, encrypt([...$sessionArray, 'verified' => true]));

                return redirect()->intended(route('dashboard', absolute: false));
            }

            $errors['code'] = 'The provided code is invalid';
        }

        return Inertia::render('Auth/Mfa', ['errors' => $errors]);
    }
}

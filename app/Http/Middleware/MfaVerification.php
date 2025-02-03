<?php

namespace App\Http\Middleware;

use App\Enums\CacheEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MfaVerification
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! empty(auth()->user()?->mfa_secret) && ! $this->isSessionValid() && ! $this->isSettingUpMFA()) {
            /** @var string $key */
            $key = config('session.mfa');

            session()->forget($key);

            auth()->guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->intended(route('login'));
        }

        return $response;
    }

    private function isSessionValid(): bool
    {
        /** @var string $key */
        $key = config('session.mfa');

        /** @var string|null $session */
        $session = session()->get($key);

        if (empty($session)) {
            return false;
        }

        /** @var array<string, bool|int> $sessionArray */
        $sessionArray = decrypt($session);

        return auth()->user()?->id === $sessionArray['uid'] && $sessionArray['verified'];
    }

    private function isSettingUpMFA(): bool
    {
        /** @var bool $cache */
        $cache = cache(CacheEnum::DISPLAY_MFA->value, false);

        return $cache;
    }
}

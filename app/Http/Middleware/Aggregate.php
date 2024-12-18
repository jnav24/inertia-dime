<?php

namespace App\Http\Middleware;

use App\Jobs\AggregateJob;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Aggregate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        /** @var string $referer */
        $referer = $request->header('referer');

        $uuid = extractUuid($referer);

        $user = auth()->user();

        if (is_string($uuid) && in_array($request->method(), ['POST', 'PATCH']) && ! empty($user)) {
            AggregateJob::dispatch(uuid: $uuid, user: $user);
        }

        return $response;
    }
}

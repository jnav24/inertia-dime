<?php

namespace App\Http\Middleware;

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

        $uuid = extractUuid($request->header('referer'));

        if (! empty($uuid) && in_array($request->method(), ['POST', 'PATCH'])) {
            dd('Call Aggregate Job');
        }

        return $response;
    }
}

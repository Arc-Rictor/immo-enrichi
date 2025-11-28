<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckForActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment() !== 'testing' && $request->user() && $request->user()->type !== 'admin') {
            if ($request->user() && !$request->user()->subscribed($request->user()->type)) {
                return \response()->redirectTo('/subscription-checkout');
            }
        }
        return $next($request);
    }
}

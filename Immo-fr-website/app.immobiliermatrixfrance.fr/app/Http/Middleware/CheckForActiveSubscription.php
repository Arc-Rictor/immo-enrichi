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
            $user = $request->user();
            
            // Check if user has either an active subscription OR is on trial
            if (!($user->subscribed($user->type) || $user->onTrial())) {
                return \response()->redirectTo('/subscription-checkout');
            }
        }
        return $next($request);
    }
}

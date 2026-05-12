<?php

namespace App\Http\Middleware;

use App\Actions\Auth\CheckAgentRegistration;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateAgentRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->type === 'agent') {
            return (new CheckAgentRegistration())->execute($request->user())
                ? $next($request)
                : redirect()->route('register.agent');
        }

        return $next($request);
    }
}

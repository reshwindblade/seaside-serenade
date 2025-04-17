<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfHasMagicalGirl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is authenticated and has a magical girl, redirect to the dashboard
        if (auth()->check() && auth()->user()->hasMagicalGirl() && $request->routeIs('magical-girl.create')) {
            return redirect()->route('magical-girl.show')
                ->with('info', 'You already have a magical girl character.');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    public function handle(Request $request, Closure $next): Response
    {
        // If the user is logged in AND has a banned_at timestamp...
        if (Auth::check() && Auth::user()->banned_at) {
            
            // Log them out immediately
            Auth::logout();

            // Clear their session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Send them to the login page with a clear message
            return redirect()->route('login')->with('status', 'Votre compte a été banni par un administrateur.');
        }

        return $next($request);
    }
}

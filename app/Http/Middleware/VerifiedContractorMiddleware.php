<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedContractorMiddleware
{
    /**
     * Handle an incoming request - check if contractor is verified.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        // If user is admin, allow access
        if ($user && $user->isAdmin()) {
            return $next($request);
        }
        
        // Bypass verification check for contractors - all clients are considered verified
        // if ($user && $user->isContractor() && !$user->isVerified()) {
        //     return redirect()->route('verification.index');
        // }
        
        return $next($request);
    }
} 
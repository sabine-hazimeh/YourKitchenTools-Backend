<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    // Check if the user is authenticated
    $user = Auth::user();

    // If no user is authenticated, return unauthorized
    if (!$user) {
        return response()->json([
            'message' => 'Unauthorized - No user authenticated'
        ], 401); // 401 for unauthorized, not 403
    }

    // Check if the user has the admin role
    if ($user->role != 'admin') {
        return response()->json([
            'message' => 'Unauthorized - Admin access required'
        ], 403); // 403 for forbidden, since the user is authenticated but not authorized
    }

    return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated. Please provide a valid token.'], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Admins only. Your role: ' . ($user->role ?? 'none')], 403);
        }

        return $next($request);
    }
}

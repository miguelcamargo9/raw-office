<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateApiKey
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('API-KEY') !== env('API_KEY')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

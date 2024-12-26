<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if ($request->user() && in_array($request->user()->Role, $roles)) {
            return $next($request);
        }
    
        return response()->json(['message' => 'Forbidden'], 403);
    }    
}

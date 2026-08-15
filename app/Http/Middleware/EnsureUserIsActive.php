<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->statut !== 'active') {
            return response()->json(['message' => 'Utilisateur inactif.'], 403);
        }

        return $next($request);
    }
}

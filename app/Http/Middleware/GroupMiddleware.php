<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Group;
use Symfony\Component\HttpFoundation\Response;

class GroupMiddleware {
    public function handle(Request $request, Closure $next, $requiredGroup): Response {
        $user = auth()->user();

        if (!$user || !$user->group || $user->group->name !== $requiredGroup) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}




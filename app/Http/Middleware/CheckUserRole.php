<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole {
    public function handle(Request $request, Closure $next, $role = null) {
        if (!$role) {
            return abort(403, 'Unauthorized access - Role is not defined.');
        }

        if (!Auth::check() || Auth::user()->group->name !== $role) {
            return redirect()->route('unauthorized'); // ✅ Redirect unauthorized users
        }

        return $next($request);
    }
}

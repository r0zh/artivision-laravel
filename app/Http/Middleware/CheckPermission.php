<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class CheckPermission {
    public function handle(Request $request, Closure $next, $roleName) {
        // Retrieve the authenticated user
        $user = $request->user();
        // Check if the user has the required permission
        if ($user->hasRole($roleName)) {
            return $next($request);
        }
        // Redirect the user to the home page
        return redirect('/');
    }
}


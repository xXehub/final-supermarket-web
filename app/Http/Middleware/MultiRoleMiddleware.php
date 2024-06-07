<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class MultiRoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check() && Auth::user()->hasAnyRole($roles)) {
            return $next($request);
        }

        return response()->view('errors.noperms', [], 403);

        // return abort(403, 'GAK PUNYA AKSES YA MAS :P.');
    }
}

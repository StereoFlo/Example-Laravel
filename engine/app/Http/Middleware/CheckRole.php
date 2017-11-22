<?php

namespace RecycleArt\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param                           $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (empty($request->user()) || !$request->user()->hasRole($role)) {
            \abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}

<?php

namespace RecycleArt\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RecycleArt\Models\User;

/**
 * Class IsAdmin
 * @package RecycleArt\Http\Middleware
 */
class IsAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->user()) || !$request->user()->authorizeRoles([User::ROLE_MODERATOR, User::ROLE_ADMIN, User::ROLE_AUTHOR])) {
            \abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }
}

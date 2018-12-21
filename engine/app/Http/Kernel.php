<?php

namespace RecycleArt\Http;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use RecycleArt\Http\Middleware\CheckRole;
use RecycleArt\Http\Middleware\EncryptCookies;
use RecycleArt\Http\Middleware\ForceHttps;
use RecycleArt\Http\Middleware\IsAdmin;
use RecycleArt\Http\Middleware\IsModerator;
use RecycleArt\Http\Middleware\RedirectIfAuthenticated;
use RecycleArt\Http\Middleware\TrimStrings;
use RecycleArt\Http\Middleware\TrustProxies;
use RecycleArt\Http\Middleware\VerifyCsrfToken;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        TrustProxies::class,
        ForceHttps::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'checkRole'   => CheckRole::class,
        'isAdmin'     => IsAdmin::class,
        'isModerator' => IsModerator::class,
        'auth'        => Authenticate::class,
        'auth.basic'  => AuthenticateWithBasicAuth::class,
        'bindings'    => SubstituteBindings::class,
        'can'         => Authorize::class,
        'guest'       => RedirectIfAuthenticated::class,
        'throttle'    => ThrottleRequests::class,
    ];
}

<?php

namespace App\Http;

use App\Http\Middleware\AccessForWeekend;
use App\Http\Middleware\AccessForWeekend2;
use App\Http\Middleware\AccessOvertimeRemote;
use App\Http\Middleware\AttendnaceAccess;
use App\Http\Middleware\AuthProductions;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

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
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
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
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        'active' => \App\Http\Middleware\AuthActive::class,
        'admin' => \App\Http\Middleware\AuthAdmin::class,
        'user' => \App\Http\Middleware\AuthUser::class,
        'hd' => \App\Http\Middleware\AuthHd::class,
        'gm' => \App\Http\Middleware\AuthGm::class,
        'hr' => \App\Http\Middleware\AuthHr::class,
        'hrd' => \App\Http\Middleware\AuthHrd::class,
        'koor' => \App\Http\Middleware\AuthKoor::class,
        'spv' => \App\Http\Middleware\AuthSPV::class,
        'pm' => \App\Http\Middleware\AuthPM::class,
        'producer' => \App\Http\Middleware\AuthProducer::class,
        'level_hrd' => \App\Http\Middleware\AuthLeve_HRD::class,
        'payroll' => \App\Http\Middleware\AuthPayroll::class,
        'it' => \App\Http\Middleware\AuthIT::class,
        'programmer' => \App\Http\Middleware\AuthProgrammer::class,
        'pipeline'  => \App\Http\Middleware\AuthPipeline::class,
        'pipelineTechnical' => \App\Http\Middleware\AuthPipelineTechnical::class,
        'pipelineTechnology' => \App\Http\Middleware\AuthPipelineTechnology::class,
        'hd_production'  => \App\Http\Middleware\AuthHDProduction::class,
        'GA'        => \App\Http\Middleware\AuthHR_GA::class,
        'FacilitesCoordinator' => \App\Http\Middleware\AuthFaciltiCoordinator::class,
        'Finance' => \App\Http\Middleware\AuthFinance::class,
        'infiniteStudios' => \App\Http\Middleware\AuthInfiniteStudios::class,
        'facilityAdmin' => \App\Http\Middleware\AuthFacilitiesAdmin::class,
        'deptApprovedHOD'   =>  \App\Http\Middleware\authDeptApprovedHOD::class,
        'production' => AuthProductions::class,
        'AccessOvertimeRemote' => AccessOvertimeRemote::class,

        'Saturday'  => AccessForWeekend::class,
        'Sunday'    => AccessForWeekend2::class,
        'attendance' => AttendnaceAccess::class,
    ];
}
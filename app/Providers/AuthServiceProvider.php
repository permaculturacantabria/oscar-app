<?php

namespace App\Providers;

use App\Models\Escucha;
use App\Models\Proceso;
use App\Models\Sesion;
use App\Models\Tema;
use App\Models\User;
use App\Policies\EscuchaPolicy;
use App\Policies\ProcesoPolicy;
use App\Policies\SesionPolicy;
use App\Policies\TemaPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
        Escucha::class => EscuchaPolicy::class,
        Sesion::class => SesionPolicy::class,
        Proceso::class => ProcesoPolicy::class,
        Tema::class => TemaPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
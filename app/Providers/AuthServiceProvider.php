<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Card;
use App\Models\Jeep;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use App\Models\Fares;
use App\Models\Queue;
use App\Models\Topup;
use App\Models\Places;
use App\Models\Revenue;
use App\Models\Triplog;
use App\Models\Permission;
use App\Policies\CardPolicy;
use App\Policies\FarePolicy;
use App\Policies\JeepPolicy;
use App\Policies\RolePolicy;
use App\Policies\TripPolicy;
use App\Policies\UserPolicy;
use App\Policies\PlacePolicy;
use App\Policies\QueuePolicy;
use App\Policies\TopupPolicy;
use App\Policies\RevenuePolicy;
use App\Policies\TriplogPolicy;
use App\Policies\PermissionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Permission::class => PermissionPolicy::class,
        Card::class => CardPolicy::class,
        Jeep::class => JeepPolicy::class,
        Queue::class => QueuePolicy::class,
        Revenue::class => RevenuePolicy::class,
        Places::class => PlacePolicy::class,
        Fares::class => FarePolicy::class,
        Trip::class => TripPolicy::class,
        Triplog::class => TriplogPolicy::class,
        Topup::class => TopupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

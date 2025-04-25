<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Project' => 'App\Policies\ProjectPolicy',
        'App\Models\Permit' => 'App\Policies\PermitPolicy',
        'App\Models\Task' => 'App\Policies\TaskPolicy',
        'App\Models\Notification' => 'App\Policies\NotificationPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePolicies();

        //
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        //
    }

    /**
     * Configure the permissions for the application.
     *
     * @return void
     */
    protected function configurePolicies()
    {
        //
    }
} 
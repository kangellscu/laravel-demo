<?php

namespace App\Providers;

use Auth;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->extendAuthManager();
        parent::registerPolicies($gate);
    }

    private function extendAuthManager()
    {
        Auth::extend('extended-eloquent', function($app) {
            // AuthManager allows us only provide UserProvider instead of
            // the whole Guard implmenetation
            return new \App\Auth\UserProvider(
                new \App\Hashing\PasswordHasher(),
                $app['config']['auth.model']
            );
        });
    }
}

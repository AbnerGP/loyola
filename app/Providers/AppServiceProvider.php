<?php

namespace App\Providers;

use Bouncer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\AbstractPaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Bouncer::tables([
            'abilities' => 'bouncer_abilities',
            'permissions' => 'bouncer_permissions',
            'roles' => 'bouncer_roles',
            'assigned_roles' => 'bouncer_assigned_roles'
        ]);

       AbstractPaginator::defaultView("pagination::bootstrap-4");
       AbstractPaginator::defaultSimpleView("pagination::simple-bootstrap-4");
       //$this->app['request']->server->set('HTTPS','on');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

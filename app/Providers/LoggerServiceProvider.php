<?php
namespace App\Providers;

use jeremykenedy\LaravelLogger\LaravelLoggerServiceProvider;


class LoggerServiceProvider extends LaravelLoggerServiceProvider
{
    protected $listeners = [

        'Illuminate\Auth\Events\Attempting' => [
            'App\Listeners\LogAuthenticationAttempt',
        ],

        'Illuminate\Auth\Events\Authenticated' => [
            'App\Listeners\LogAuthenticated',
        ],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogSuccessfulLogin',
        ],

        'Illuminate\Auth\Events\Failed' => [
            'App\Listeners\LogFailedLogin',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogSuccessfulLogout',
        ],

        'Illuminate\Auth\Events\Lockout' => [
            'App\Listeners\LogLockout',
        ],

        'Illuminate\Auth\Events\PasswordReset' => [
            'App\Listeners\LogPasswordReset',
        ],

    ];

    public function register()
    {
        //$this->loadRoutesFrom(base_path('/routes/activity.php'));
        $this->loadViewsFrom(base_path().'/resources/views/', 'LaravelLogger');
        $this->loadMigrationsFrom(base_path().'/database/migrations');
        if (file_exists(config_path('laravel-logger.php'))) {
            $this->mergeConfigFrom(config_path('laravel-logger.php'), 'LaravelLogger');
        } else {
            $this->mergeConfigFrom(base_path().'/config/laravel-logger.php', 'LaravelLogger');
        }
        $this->registerEventListeners();
        $this->publishFiles();
    }


    /**
     * Register the list of listeners and events.
     *
     * @return void
     */
    protected function registerEventListeners()
    {
        $listeners = $this->getListeners();
        foreach ($listeners as $listenerKey => $listenerValues) {
            foreach ($listenerValues as $listenerValue) {
                \Event::listen($listenerKey,
                    $listenerValue
                );
            }
        }
    }

    /**
     * Publish files for Laravel Logger.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $publishTag = 'laravellogger';

        $this->publishes([
            __DIR__.'/config/laravel-logger.php' => base_path('config/laravel-logger.php'),
        ], $publishTag);

        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/vendor/'.$publishTag),
        ], $publishTag);

        $this->publishes([
            __DIR__.'/resources/lang' => base_path('resources/lang/vendor/'.$publishTag),
        ], $publishTag);
    }


    /**
     * Get the list of listeners and events.
     *
     * @return array
     */
    private function getListeners()
    {
        return $this->listeners;
    }

}
<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Http\Traits\Activity;

class LogSuccessfulLogin
{
    use Activity;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     *
     * @return void
     */
    public function handle(Login $event)
    {
        if (config('LaravelLogger.logSuccessfulLogin')) {
            $this->activity('Inició sesión', null, null, null, 'AUTH');
        }
    }
}

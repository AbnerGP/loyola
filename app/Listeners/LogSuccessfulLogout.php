<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Http\Traits\Activity;

class LogSuccessfulLogout
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
     * @param Logout $event
     *
     * @return void
     */
    public function handle(Logout $event)
    {
        /*if (config('LaravelLogger.logSuccessfulLogout')) {
            Activity::activity('Cerró sesión', null, null, null, 'AUTH');
        }*/
    }
}

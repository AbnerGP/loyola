<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Http\Traits\Activity;

class LogAuthenticated
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
     * Handle ANY authenticated event.
     *
     * @param Authenticated $event
     *
     * @return void
     */
    public function handle(Authenticated $event)
    {
        if (config('LaravelLogger.logAllAuthEvents')) {
            Activity::activity('Authenticated Activity');
        }
    }
}

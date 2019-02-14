<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Attempting;
use App\Http\Traits\Activity;

class LogAuthenticationAttempt
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
     * @param Attempting $event
     *
     * @return void
     */
    public function handle(Attempting $event)
    {
        if (config('LaravelLogger.logAuthAttempts')) {
            Activity::activity('Authenticated Attempt');
        }
    }
}

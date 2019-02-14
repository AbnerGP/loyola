<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use App\Http\Traits\Activity;

class LogFailedLogin
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
     * @param Failed $event
     *
     * @return void
     */
    public function handle(Failed $event)
    {
        if (config('LaravelLogger.logFailedAuthAttempts')) {
            $arr['username'] = $event->credentials['username'];
            $this->activity('Intento de inicio de sesión fallido', null, null, serialize($arr), 'AUTH');
        }
    }
}

<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Lockout;
use App\Http\Traits\Activity;

class LogLockout
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
     * @param Lockout $event
     *
     * @return void
     */
    public function handle(Lockout $event)
    {
        if (config('LaravelLogger.logLockOut')) {
            $this->activity('Cuenta bloqueada', null, null, null, 'AUTH');
        }
    }
}

<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use App\Http\Traits\Activity;

class LogPasswordReset
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
     * @param PasswordReset $event
     *
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        if (config('LaravelLogger.logPasswordReset')) {
            $this->activity('Cambio de contraseña', null, null, null, 'AUTH');
        }
    }
}

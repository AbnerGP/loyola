<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Http\Traits\Activity;

class EventServiceProvider extends ServiceProvider
{
    //use Activity;
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();


       // Event::listen('eloquent.updated: *', function($model, $second){
       //    $this->setActivity2('TESTO DE ACTIVITY: '.$second);
       // });




        //
    }
}

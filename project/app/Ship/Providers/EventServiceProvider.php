<?php

namespace App\Ship\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Ship\Events\ExampleEvent::class => [
            \App\Ship\Listeners\ExampleListener::class,
        ],
    ];
}

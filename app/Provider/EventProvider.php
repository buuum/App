<?php

namespace App\Provider;

use App\Support\EventResolver;
use Buuum\Event;
use League\Container\Container;

class EventProvider
{
    public function register(Container $app)
    {
        $app->share('event', function () use ($app) {

            $paths = $app->get('paths');

            $event = Event::getInstance();
            $event->loadListeners($paths['listeners']);
            $event->setResolver(new EventResolver($app));

            return $event;
        });
    }
}

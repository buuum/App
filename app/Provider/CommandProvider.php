<?php

namespace App\Provider;

use League\Container\Container;

class CommandProvider
{

    public function register(Container $app)
    {
        $app->share('commands', function () use ($app) {
            $paths = $app->get('paths');
            $commands = $this->getCommands($paths['commands']);

            return array_map(function ($commandName) use ($app) {
                $app->add($commandName);
                return $app->get($commandName)->setContainer($app);
            }, $commands);

        });
    }

    /**
     * @param string $file
     * @return array
     */
    private function getCommands($file)
    {
        return include $file;
    }

}
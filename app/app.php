<?php

$app = new \League\Container\Container;

$app->share('paths', function () {
    return [
        'app'      => __DIR__,
        'public'   => __DIR__ . '/../httpdocs',
        'config'   => __DIR__ . '/config.php',
        'views'    => __DIR__ . '/Views',
        'storage'  => __DIR__ . '/../temp',
        'log'      => __DIR__ . '/../log',
        'routes'   => __DIR__ . '/routes.php',
        'commands' => __DIR__ . '/commands.php',
        'version'  => __DIR__ . '/../version.json',
    ];
});

$providers = [
    new Application\Provider\ConfigProvider,
    new Application\Provider\SessionProvider,
    new Application\Provider\CacheProvider,
    new Application\Provider\DBProvider,
    new Application\Provider\ORMProvider,
    new Application\Provider\RequestProvider,
    new Application\Provider\RouterProvider,
    new Application\Provider\ViewProvider,
    new Application\Provider\DispatchProvider,
    new Application\Provider\CommandProvider
];

array_walk($providers, function ($provider) use ($app) {
    $provider->register($app);
});

return $app;
<?php

$app = new \League\Container\Container;

$app->share('paths', function () {
    return [
        'root'     => __DIR__ . '/..',
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
    new App\Provider\RequestProvider,
    new App\Provider\ConfigProvider,
    new App\Provider\DBProvider,
    new App\Provider\RouterProvider,
    new App\Provider\ViewProvider,
    new App\Provider\DispatchProvider,
    new App\Provider\CommandProvider,
    new App\Provider\AppProvider,
    new App\Provider\SessionProvider,
];
array_walk($providers, function ($provider) use ($app) {
    $provider->register($app);
});

return $app;
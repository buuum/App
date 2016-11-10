<?php

namespace App\Provider;

use App\Services\Mailer;
use App\Support\AppSupport;
use App\Support\DB;
use Buuum\Encoding\Encode;
use Buuum\Mail;
use League\Container\Container;

class AppProvider
{

    public function register(Container $app)
    {

        $config = $app->get('config');

        AppSupport::setConfig($config);

        Mail::setConfig($config->get('mail'));
        Mailer::setRouter($app->get('Buuum\Dispatcher'));

        Encode::$key = $config->get('encode.key');
        Encode::setAlgorithm($config->get('encode.algorithm'));

        DB::setCapsule( $app->get('database') );
    }

}
<?php

namespace App\Provider;

use App\Services\Mailer;
use App\Support\AppSupport;
use App\Support\DB;
use Buuum\Encoding\Encode;
use Buuum\Mail;
use Buuum\MailerHandler\SwiftMailerHandler;
use Buuum\S3;
use Intervention\Image\ImageManagerStatic;
use League\Container\Container;

class AppProvider
{

    public function register(Container $app)
    {

        //$app->share('mailhandler', function() use ($app){
        //    $config = $app->get('config');
        //    $paths = $config->get('paths');
        //    $options = $config->get('mail');
        //    $options['spool_directory'] = $paths['storage'] . '/spool';
        //    return new SwiftMailerHandler($options);
        //});

        $config = $app->get('config');

        //$r = $app->get('Symfony\Component\HttpFoundation\Request');
        AppSupport::setConfig($config);
        //AppSupport::initialize($r->getPathInfo());
        //AppSupport::loadLang($config->get('lang'));

        //$mail = Mail::getInstance();
        //$mail->setHandler($app->get('mailhandler'));

        Encode::$key = $config->get('encode.key');
        Encode::setAlgorithm($config->get('encode.algorithm'));

        DB::setCapsule($app->get('database'));
    }

}

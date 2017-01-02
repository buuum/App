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

        $app->share('mailhandler', function() use ($app){
            $config = $app->get('config');
            $paths = $config->get('paths');
            $options = $config->get('mail');
            $options['spool_directory'] = $paths['storage'] . '/spool';
            return new SwiftMailerHandler($options);
        });

        $config = $app->get('config');

        //$r = $app->get('Symfony\Component\HttpFoundation\Request');
        AppSupport::setConfig($config);
        //AppSupport::initialize($r->getPathInfo());
        //AppSupport::loadLang($config->get('lang'));

        $mail = Mail::getInstance();
        $mail->setHandler($app->get('mailhandler'));

        Encode::$key = $config->get('encode.key');
        Encode::setAlgorithm($config->get('encode.algorithm'));

        S3::setAuth($config->get('environment.aws.key'), $config->get('environment.aws.secret'));
        S3::setBucket($config->get('environment.aws.bucket'));
        S3::setUrls($config->get('environment.aws.urls'));
        $headers = [
            'Cache-Control' => 'max-age=2592000',
            'Expires'       => 2592000,
        ];
        S3::setDefaultHeaders($headers);

        DB::setCapsule($app->get('database'));
    }

}

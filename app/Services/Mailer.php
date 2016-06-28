<?php

namespace App\Services;


use Buuum\Dispatcher;
use Buuum\Mail;

class Mailer
{

    private static $router;

    public static function sendConfirm($to)
    {
        //$link = self::getRouter()->getUrlRequest('mail_confirm', ['to' => $to]);
        $link = 'http://opinamus.dev/opinamus/mail/confirm/'.$to.'/';
        Mail::to($to)->subject('Confirm email')->body(self::getBody($link))->send();
    }

    public static function sendReset($to)
    {
        $link = 'http://opinamus.dev/opinamus/mail/reset/'.$to.'/';
        Mail::to($to)->subject('Reset pass')->body(self::getBody($link))->send();
    }

    public static function getBody($link)
    {
        $html = file_get_contents($link);
        return $html;
    }

    public static function setRouter(Dispatcher $router)
    {
        self::$router = $router;
    }

    /**
     * @return Dispatcher
     */
    public static function getRouter()
    {
        return self::$router;
    }
}
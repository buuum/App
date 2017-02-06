<?php

namespace App\Controller\Adm\User;

use App\Controller\Adm\Controller;
use App\ViewsBuilder\Adm\Mails\UserMail;
use Buuum\Encoding\Encode;
use Buuum\Mail;

class MailController extends Controller
{

    public function sendforgot($event_name, $email)
    {
        $mail = Mail::getInstance();

        $email = Encode::encode([
            'email' => $email
        ]);
        $link = $this->router->getUrlRequest('user_forgot_pass', ['emailencode' => $email]);

        $page = new UserMail($this->prepareData([
            'link' => $link
        ]));
        $body = $page->forgot();

        try {
            $mail->to($email)->subject(_e('Recuperar contraseña'))->body($body)->send();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
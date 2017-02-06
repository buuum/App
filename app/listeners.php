<?php

use Buuum\Event;

return function (Event $event) {

    //$event->addListener('mail.send.confirm', [App\Controller\Web\Mail\User::class, 'sendconfirm']);
    $event->addListener('mail.send.forgot', [\App\Controller\Adm\User\MailController::class, 'sendforgot']);

};
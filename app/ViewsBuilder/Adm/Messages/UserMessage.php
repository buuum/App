<?php

namespace App\ViewsBuilder\Adm\Messages;

use App\ViewsBuilder\Adm\Message;

class UserMessage extends Message
{

    public static function success_edit_message()
    {
        return self::static_render('messages/users/success_edit');
    }

    public static function success_add_message()
    {
        return self::static_render('messages/users/success_add');
    }

    public static function success_forgot_message()
    {
        return self::static_render('messages/users/success_forgot');
    }

    public static function success_reset_message()
    {
        return self::static_render('messages/users/success_reset');
    }

}
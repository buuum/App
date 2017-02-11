<?php

namespace App\ViewsBuilder\Adm\Messages;

use App\ViewsBuilder\Adm\Message;

class PostMessage extends Message
{

    public static function success_edit_message()
    {
        return self::static_render('messages/posts/success_edit');
    }

    public static function success_add_message()
    {
        return self::static_render('messages/posts/success_add');
    }

}
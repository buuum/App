<?php

namespace App\ViewsBuilder\Adm\Messages;

use App\ViewsBuilder\Adm\Message;

class RolMessage extends Message
{

    public static function success_edit_message()
    {
        return self::static_render('messages/roles/success_edit');
    }

    public static function success_add_message()
    {
        return self::static_render('messages/roles/success_add');
    }

}
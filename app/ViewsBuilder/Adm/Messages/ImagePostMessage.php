<?php

namespace App\ViewsBuilder\Adm\Messages;

use App\ViewsBuilder\Adm\Message;

class ImagePostMessage extends Message
{

    public static function success_edit_message()
    {
        return self::static_render('messages/imagespost/success_edit');
    }

    public static function success_add_message()
    {
        return self::static_render('messages/imagespost/success_add');
    }

}
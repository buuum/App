<?php

namespace App\ViewsBuilder\Adm\Mails;

use App\ViewsBuilder\Adm\Mails;

class UserMail extends Mails
{

    public function forgot()
    {
        $page = $this->render('mails/user/forgot', $this->data);
        return $page;
    }

}
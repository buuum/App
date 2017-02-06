<?php

namespace App\ViewsBuilder\Adm;

class Mails extends \App\ViewsBuilder\View
{

    public function renderLayoutBase($page)
    {
        return $this->render('mails/layout/base', [
            'page'       => $page
        ]);
    }

}
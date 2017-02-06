<?php

namespace App\ViewsBuilder\Web;

class Page extends View
{

    public function renderLayoutBase($page)
    {
        return $this->render('layouts/base', [
            'page' => $page
        ]);
    }

}
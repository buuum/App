<?php

namespace App\ViewsBuilder\Web\Pages;

use App\ViewsBuilder\Web\Page;

class HomePage extends Page
{

    public function home()
    {
        $this->simpleHeader('Web', 'Web');

        $page = $this->render('pages/home');
        return $this->renderLayoutBase($page);
    }

}
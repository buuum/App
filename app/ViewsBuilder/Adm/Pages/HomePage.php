<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class HomePage extends Page
{

    public function home()
    {

        $this->simpleHeader('Admin', 'Admin');
        $breadcrumb = [];
        $page = $this->render('pages/home');

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

}
<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class ErrorPage extends Page
{
    public function showError($type = 404)
    {
        $this->simpleHeader('Admin', 'Admin');

        $page = $this->render("pages/errors/error$type");

        return $this->renderLayout('layouts/center_box', $page);

    }
}
<?php

namespace App\ViewsBuilder\Web\Pages;

use App\ViewsBuilder\Web\Page;

class ErrorPage extends Page
{
    public function showError($type = 404)
    {
        $this->simpleHeader('Admin', 'Admin');
        $page = $this->render("pages/errors/error$type");
        return $this->renderLayoutBase($page);
    }
}
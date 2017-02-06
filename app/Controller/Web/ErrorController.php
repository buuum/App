<?php

namespace App\Controller\Web;

use App\ViewsBuilder\Web\Pages\ErrorPage;

class ErrorController extends Controller
{
    public function error404()
    {
        $error_page = new ErrorPage();
        return $error_page->showError(404);
    }

    public function error405()
    {
        $error_page = new ErrorPage();
        return $error_page->showError(405);
    }

    public function error500(\Exception $e = null)
    {
        $error_page = new ErrorPage();
        return $error_page->showError(500);
    }
}

<?php

namespace App\Controller\Adm\User;

use App\Controller\Adm\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogoutController extends Controller
{

    public function get()
    {
        $this->session->clear();
        $response = new RedirectResponse($this->router->getUrlRequest('login_adm'));
        $response->headers->clearCookie('remember');
        return $response;
    }

}
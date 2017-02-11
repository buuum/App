<?php

namespace App\Controller\Adm\User;

use App\Controller\Adm\Controller;
use App\Facades\Factory\UserFactory;
use App\Facades\Handler\UserHandler;
use App\Form\User\UserForm;
use App\ViewsBuilder\Adm\Pages\UserPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $validation = new UserForm('login');
        $data = $validation->filter($this->request->request->all());

        if (!$errors = $validation->validate($data)) {
            // form success
            return $this->onFormSuccess($data);
        }

        // form error
        return $this->renderView($data, $errors);

    }

    public function onFormSuccess($data)
    {
        $user = UserFactory::get()->getByField('email', $data['email']);
        $user->setSession($this->session);

        $response = new RedirectResponse($this->router->getUrlRequest('home_adm'));

        if (!empty($data['remember'])) {
            $response->headers->setCookie($user->setCookie('remember'));
        }

        return $response;
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;
        $page = new UserPage($this->prepareData($data));
        return $page->login();
    }
}


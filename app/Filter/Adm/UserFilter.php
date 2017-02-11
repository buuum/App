<?php

namespace App\Filter\Adm;

use App\Facades\Handler\UserHandler;
use App\Filter\Filter;
use App\Facades\Factory\UserFactory;
use App\Model\UserModel;
use Buuum\Encoding\Encode;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserFilter extends Filter
{

    public function enterWithoutLogin()
    {
        if ($this->session->get('login', false)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => []
        ];
    }

    public function enterWithLogin()
    {

        if (!$this->session->get('login', false)) {
            if (!$cookie = $this->request->cookies->get('remember')) {
                return new RedirectResponse($this->router->getUrlRequest('login_adm'));
            }

            $data = Encode::decode($cookie);
            $user = UserFactory::get()->find($data['id']);
            $user->setSession($this->session);

        }

        return [
            'passed'   => true,
            'response' => []
        ];
    }

    public function checkUser($id)
    {

        if (!$item = UserFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'user' => $item
            ]
        ];
    }

    public function checkEmailEncode($emailencode)
    {
        try {
            $data = Encode::decode($emailencode);
            $user = UserFactory::get()->getByField('email', $data['email']);
        } catch (\Exception $e) {
            return new RedirectResponse($this->router->getUrlRequest('login_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'user' => $user
            ]
        ];
    }

}

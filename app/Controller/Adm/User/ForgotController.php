<?php

namespace App\Controller\Adm\User;

use App\Controller\Adm\Controller;
use App\Facades\Handler\UserHandler;
use App\Form\User\UserForm;
use App\ViewsBuilder\Adm\Messages\UserMessage;
use App\ViewsBuilder\Adm\Pages\UserPage;
use Buuum\Encoding\Encode;
use Buuum\Event;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ForgotController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $validation = new UserForm('forgot');
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

        Event::getInstance()->fire('mail.send.forgot', $data['email']);

        $this->flash->set('messages', [
            'class' => UserMessage::class,
            'type'  => 'success_forgot_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('home_adm'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;
        $page = new UserPage($this->prepareData($data));
        return $page->forgot();
    }

    public function getemail($user)
    {
        return $this->renderForgotView($user->toArray());
    }

    public function postemail($user)
    {
        $validation = new UserForm('reset_pass');
        $data = $validation->filter($this->request->request->all());

        if (!$errors = $validation->validate($data)) {
            // form success
            return $this->onFormSuccessPassword($user, $data);
        }

        // form error
        $data = array_merge($user->toArray(), $data);
        return $this->renderForgotView($data, $errors);
    }

    public function onFormSuccessPassword($user, $data)
    {

        $user->setPassword($data['pass']);

        $this->flash->set('messages', [
            'class' => UserMessage::class,
            'type'  => 'success_reset_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('login_adm'));
    }

    public function renderForgotView($data = [], $errors = [])
    {
        $emailencode = Encode::encode([
            'email' => $data['email']
        ]);

        $data['errors'] = $errors;
        $data['emailencode'] = $emailencode;
        $page = new UserPage($this->prepareData($data));
        return $page->setpassword();
    }
}


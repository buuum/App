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

    public function getemail($email)
    {
        return $this->renderForgotView($email);
    }

    public function postemail($email)
    {
        $validation = new UserForm('reset_pass');
        $data = $validation->filter($this->request->request->all());

        if (!$errors = $validation->validate($data)) {
            // form success
            return $this->onFormSuccessPassword($email, $data);
        }

        // form error
        return $this->renderForgotView($email, $data, $errors);
    }

    public function onFormSuccessPassword($email, $data)
    {

        UserHandler::get()->setPasswordFromEmail($email, $data['password']);

        $this->flash->set('messages', [
            'class' => UserMessage::class,
            'type'  => 'success_reset_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('login_adm'));
    }

    public function renderForgotView($email, $data = [], $errors = [])
    {
        $emailencode = Encode::encode([
            'email' => $email
        ]);

        $data['errors'] = $errors;
        $data['emailencode'] = $emailencode;
        $page = new UserPage($this->prepareData($data));
        return $page->setpassword();
    }
}


<?php

namespace App\Controller\Adm\User;

use App\Controller\Adm\Controller;
use App\Facades\Factory\CountryFactory;
use App\Facades\Factory\RolFactory;
use App\Form\User\UserForm;
use App\Handler\UserHandler;
use App\ViewsBuilder\Adm\Messages\UserMessage;
use App\ViewsBuilder\Adm\Pages\UserPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get(UserHandler $user)
    {
        return $this->renderView($user->toArray());
    }

    public function post(UserHandler $user)
    {
        $form = new UserForm('edit');

        //$data = array_merge($user->toArray(), $this->request->request->all());
        $data = $this->request->request->all();
        $data['id'] = $user->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($user, $data);
        }

        // form error
        $data = array_merge($user->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess(UserHandler $user, $data)
    {
        $user->edit($data);

        $this->flash->set('messages', [
            'class' => UserMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('users_edit', [
            'id' => $user->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;
        $data['paises'] = CountryFactory::get()->getAll();
        $data['list_roles'] = RolFactory::get()->getAll();

        $pagina = new UserPage($this->prepareData($data));
        return $pagina->edit();
    }

}

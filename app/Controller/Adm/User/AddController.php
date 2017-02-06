<?php

namespace App\Controller\Adm\User;

use App\Controller\Adm\Controller;
use App\Facades\Factory\CountryFactory;
use App\Facades\Factory\RolFactory;
use App\Facades\Factory\UserFactory;
use App\Form\User\UserForm;
use App\ViewsBuilder\Adm\Messages\UserMessage;
use App\ViewsBuilder\Adm\Pages\UserPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new UserForm('add');
        $data = $form->filter($this->request->request->all());

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($data);
        }

        // form error
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($data)
    {
        UserFactory::get()->buildFromAdmin($data);

        $this->flash->set('messages', [
            'class' => UserMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('users_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;
        $data['paises'] = CountryFactory::get()->getAll();
        $data['list_roles'] = RolFactory::get()->getAll();

        $pagina = new UserPage($this->prepareData($data));
        return $pagina->add();
    }

}

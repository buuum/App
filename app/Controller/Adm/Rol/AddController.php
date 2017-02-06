<?php

namespace App\Controller\Adm\Rol;

use App\Controller\Adm\Controller;
use App\Facades\Factory\RolFactory;
use App\Form\Rol\RolForm;
use App\ViewsBuilder\Adm\Messages\RolMessage;
use App\ViewsBuilder\Adm\Pages\RolPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new RolForm('add');
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
        RolFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => RolMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('roles_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new RolPage($this->prepareData($data));
        return $pagina->add();
    }

}

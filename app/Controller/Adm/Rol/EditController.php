<?php

namespace App\Controller\Adm\Rol;

use App\Controller\Adm\Controller;
use App\Facades\Handler\RolHandler;
use App\Form\Rol\RolForm;
use App\ViewsBuilder\Adm\Messages\RolMessage;
use App\ViewsBuilder\Adm\Pages\RolPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($rol)
    {
        return $this->renderView($rol->toArray());
    }

    public function post($rol)
    {
        $form = new RolForm('edit');

        $data = array_merge($rol->toArray(), $this->request->request->all());
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($rol, $data);
        }

        // form error
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($rol, $data)
    {
        RolHandler::get()->edit($rol, $data);

        $this->flash->set('messages', [
            'class' => RolMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('roles_edit', [
            'id' => $rol->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new RolPage($this->prepareData($data));
        return $pagina->edit();
    }

}

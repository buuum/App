<?php

namespace App\Controller\Adm\Media\MediaType;

use App\Controller\Adm\Controller;
use App\Facades\Handler\MediaTypeHandler;
use App\Form\Media\MediaType\MediaTypeForm;
use App\ViewsBuilder\Adm\Messages\MediaTypeMessage;
use App\ViewsBuilder\Adm\Pages\MediaTypePage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($mediatype)
    {
        return $this->renderView($mediatype->toArray());
    }

    public function post($mediatype)
    {
        $form = new MediaTypeForm('edit');

        $data = $this->request->request->all();
        $data['id'] = $mediatype->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($mediatype, $data);
        }

        // form error
        $data = array_merge($mediatype->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($mediatype, $data)
    {
        $mediatype->edit($data);

        $this->flash->set('messages', [
            'class' => MediaTypeMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('mediastype_edit', [
            'id' => $mediatype->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new MediaTypePage($this->prepareData($data));
        return $pagina->edit();
    }

}

<?php

namespace App\Controller\Adm\Media\Media;

use App\Controller\Adm\Controller;
use App\Facades\Handler\MediaHandler;
use App\Form\Media\Media\MediaForm;
use App\ViewsBuilder\Adm\Messages\MediaMessage;
use App\ViewsBuilder\Adm\Pages\MediaPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($media)
    {
        return $this->renderView($media->toArray());
    }

    public function post($media)
    {
        $form = new MediaForm('edit');

        $data = $this->request->request->all();
        $data['id'] = $media->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($media, $data);
        }

        // form error
        $data = array_merge($media->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($media, $data)
    {
        MediaHandler::get()->edit($media, $data);

        $this->flash->set('messages', [
            'class' => MediaMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('medias_edit', [
            'id' => $media->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new MediaPage($this->prepareData($data));
        return $pagina->edit();
    }

}

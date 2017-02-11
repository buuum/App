<?php

namespace App\Controller\Adm\Media\MediaVariant;

use App\Controller\Adm\Controller;
use App\Facades\Handler\MediaVariantHandler;
use App\Form\Media\MediaVariant\MediaVariantForm;
use App\ViewsBuilder\Adm\Messages\MediaVariantMessage;
use App\ViewsBuilder\Adm\Pages\MediaVariantPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($mediavariant)
    {
        return $this->renderView($mediavariant->toArray());
    }

    public function post($mediavariant)
    {
        $form = new MediaVariantForm('edit');

        $data = $this->request->request->all();
        $data['id'] = $mediavariant->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($mediavariant, $data);
        }

        // form error
        $data = array_merge($mediavariant->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($mediavariant, $data)
    {
        $mediavariant->edit($data);

        $this->flash->set('messages', [
            'class' => MediaVariantMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('mediasvariant_edit', [
            'id' => $mediavariant->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new MediaVariantPage($this->prepareData($data));
        return $pagina->edit();
    }

}

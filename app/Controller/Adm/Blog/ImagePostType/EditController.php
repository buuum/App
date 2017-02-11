<?php

namespace App\Controller\Adm\Blog\ImagePostType;

use App\Controller\Adm\Controller;
use App\Facades\Handler\ImagePostTypeHandler;
use App\Form\Blog\ImagePostType\ImagePostTypeForm;
use App\ViewsBuilder\Adm\Messages\ImagePostTypeMessage;
use App\ViewsBuilder\Adm\Pages\ImagePostTypePage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($imageposttype)
    {
        return $this->renderView($imageposttype->toArray());
    }

    public function post($imageposttype)
    {
        $form = new ImagePostTypeForm('edit');

        $data = $this->request->request->all();
        $data['id'] = $imageposttype->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($imageposttype, $data);
        }

        // form error
        $data = array_merge($imageposttype->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($imageposttype, $data)
    {
       $imageposttype->edit($data);

        $this->flash->set('messages', [
            'class' => ImagePostTypeMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('imagesposttypes_edit', [
            'id' => $imageposttype->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new ImagePostTypePage($this->prepareData($data));
        return $pagina->edit();
    }

}

<?php

namespace App\Controller\Adm\Blog\ImagePost;

use App\Controller\Adm\Controller;
use App\Facades\Handler\ImagePostHandler;
use App\Form\Blog\ImagePost\ImagePostForm;
use App\ViewsBuilder\Adm\Messages\ImagePostMessage;
use App\ViewsBuilder\Adm\Pages\ImagePostPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($imagepost)
    {
        return $this->renderView($imagepost->toArray());
    }

    public function post($imagepost)
    {
        $form = new ImagePostForm('edit');

        $data = $this->request->request->all();
        $data['id'] = $imagepost->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($imagepost, $data);
        }

        // form error
        $data = array_merge($imagepost->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($imagepost, $data)
    {
        ImagePostHandler::get()->edit($imagepost, $data);

        $this->flash->set('messages', [
            'class' => ImagePostMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('imagespost_edit', [
            'id' => $imagepost->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new ImagePostPage($this->prepareData($data));
        return $pagina->edit();
    }

}

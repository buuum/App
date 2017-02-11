<?php

namespace App\Controller\Adm\Blog\Tag;

use App\Controller\Adm\Controller;
use App\Facades\Handler\TagHandler;
use App\Form\Blog\Tag\TagForm;
use App\ViewsBuilder\Adm\Messages\TagMessage;
use App\ViewsBuilder\Adm\Pages\TagPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($tag)
    {
        return $this->renderView($tag->toArray());
    }

    public function post($tag)
    {
        $form = new TagForm('edit');

        $data = $this->request->request->all();
        $data['id'] = $tag->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($tag, $data);
        }

        // form error
        $data = array_merge($tag->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($tag, $data)
    {
        TagHandler::get()->edit($tag, $data);

        $this->flash->set('messages', [
            'class' => TagMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('tags_edit', [
            'id' => $tag->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new TagPage($this->prepareData($data));
        return $pagina->edit();
    }

}

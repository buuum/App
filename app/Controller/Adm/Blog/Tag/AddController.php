<?php

namespace App\Controller\Adm\Blog\Tag;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\TagFactory;
use App\Form\Blog\Tag\TagForm;
use App\ViewsBuilder\Adm\Messages\TagMessage;
use App\ViewsBuilder\Adm\Pages\TagPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new TagForm('add');
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
        TagFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => TagMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('tags_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new TagPage($this->prepareData($data));
        return $pagina->add();
    }

}

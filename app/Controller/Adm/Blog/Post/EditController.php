<?php

namespace App\Controller\Adm\Blog\Post;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\CategoryFactory;
use App\Facades\Factory\Blog\ImagePostTypeFactory;
use App\Facades\Handler\PostHandler;
use App\Form\Blog\Post\PostForm;
use App\ViewsBuilder\Adm\Messages\PostMessage;
use App\ViewsBuilder\Adm\Pages\PostPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($post)
    {
        return $this->renderView($post->toArray());
    }

    public function post($post)
    {
        $form = new PostForm('edit');

        $data = $this->request->request->all();
        $data['id'] = $post->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($post, $data);
        }

        // form error
        $data = array_merge($post->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($post, $data)
    {
        $post->edit($data);

        $this->flash->set('messages', [
            'class' => PostMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('posts_edit', [
            'id' => $post->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;
        $data['list_categories'] = CategoryFactory::get()->getAll();
        $data['types'] = ImagePostTypeFactory::get()->getAll();

        $pagina = new PostPage($this->prepareData($data));
        return $pagina->edit();
    }

}

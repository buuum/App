<?php

namespace App\Controller\Adm\Blog\Post;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\CategoryFactory;
use App\Facades\Factory\Blog\ImagePostTypeFactory;
use App\Facades\Factory\Blog\PostFactory;
use App\Form\Blog\Post\PostForm;
use App\ViewsBuilder\Adm\Messages\PostMessage;
use App\ViewsBuilder\Adm\Pages\PostPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new PostForm('add');
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
        PostFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => PostMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('posts_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;
        $data['list_categories'] = CategoryFactory::get()->getAll();
        $data['types'] = ImagePostTypeFactory::get()->getAll();

        $pagina = new PostPage($this->prepareData($data));
        return $pagina->add();
    }

    public function add_tag()
    {
        $pagina = new PostPage($this->prepareData());
        return $pagina->tag();
    }

    public function add_image()
    {
        $pagina = new PostPage($this->prepareData([
            'types' => ImagePostTypeFactory::get()->getAll()
        ]));
        return $pagina->image();
    }

}

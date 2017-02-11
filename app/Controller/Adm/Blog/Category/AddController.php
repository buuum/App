<?php

namespace App\Controller\Adm\Blog\Category;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\CategoryFactory;
use App\Form\Blog\Category\CategoryForm;
use App\ViewsBuilder\Adm\Messages\CategoryMessage;
use App\ViewsBuilder\Adm\Pages\CategoryPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new CategoryForm('add');
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
        CategoryFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => CategoryMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('categories_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;
        $data['categories'] = CategoryFactory::get()->getAll();

        $pagina = new CategoryPage($this->prepareData($data));
        return $pagina->add();
    }

}

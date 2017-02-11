<?php

namespace App\Controller\Adm\Blog\Category;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\CategoryFactory;
use App\Form\Blog\Category\CategoryForm;
use App\ViewsBuilder\Adm\Messages\CategoryMessage;
use App\ViewsBuilder\Adm\Pages\CategoryPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($category)
    {
        return $this->renderView($category->toArray());
    }

    public function post($category)
    {
        $form = new CategoryForm('edit');

        $data = $this->request->request->all();
        $data['id'] = $category->id;
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($category, $data);
        }

        // form error
        $data = array_merge($category->toArray(), $data);
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($category, $data)
    {
        $category->edit($data);

        $this->flash->set('messages', [
            'class' => CategoryMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('categories_edit', [
            'id' => $category->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;
        $data['categories'] = CategoryFactory::get()->getAllWithoutMe($data['id']);

        $pagina = new CategoryPage($this->prepareData($data));
        return $pagina->edit();
    }

}

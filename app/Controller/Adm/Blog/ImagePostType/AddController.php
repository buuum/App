<?php

namespace App\Controller\Adm\Blog\ImagePostType;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\ImagePostTypeFactory;
use App\Form\Blog\ImagePostType\ImagePostTypeForm;
use App\ViewsBuilder\Adm\Messages\ImagePostTypeMessage;
use App\ViewsBuilder\Adm\Pages\ImagePostTypePage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new ImagePostTypeForm('add');
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
        ImagePostTypeFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => ImagePostTypeMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('imagesposttypes_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new ImagePostTypePage($this->prepareData($data));
        return $pagina->add();
    }

}

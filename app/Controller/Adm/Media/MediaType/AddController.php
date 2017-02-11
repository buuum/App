<?php

namespace App\Controller\Adm\Media\MediaType;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Media\MediaTypeFactory;
use App\Form\Media\MediaType\MediaTypeForm;
use App\ViewsBuilder\Adm\Messages\MediaTypeMessage;
use App\ViewsBuilder\Adm\Pages\MediaTypePage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new MediaTypeForm('add');
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
        MediaTypeFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => MediaTypeMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('mediastype_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new MediaTypePage($this->prepareData($data));
        return $pagina->add();
    }

}

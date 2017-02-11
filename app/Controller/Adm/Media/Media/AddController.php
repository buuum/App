<?php

namespace App\Controller\Adm\Media\Media;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Media\MediaFactory;
use App\Form\Media\Media\MediaForm;
use App\ViewsBuilder\Adm\Messages\MediaMessage;
use App\ViewsBuilder\Adm\Pages\MediaPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new MediaForm('add');
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
        MediaFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => MediaMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('medias_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new MediaPage($this->prepareData($data));
        return $pagina->add();
    }

}

<?php

namespace App\Controller\Adm\Media\MediaVariant;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Media\MediaVariantFactory;
use App\Form\Media\MediaVariant\MediaVariantForm;
use App\ViewsBuilder\Adm\Messages\MediaVariantMessage;
use App\ViewsBuilder\Adm\Pages\MediaVariantPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new MediaVariantForm('add');
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
        MediaVariantFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => MediaVariantMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('mediasvariant_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new MediaVariantPage($this->prepareData($data));
        return $pagina->add();
    }

}

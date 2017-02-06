<?php

namespace App\Controller\Adm\Country;

use App\Controller\Adm\Controller;
use App\Facades\Factory\CountryFactory;
use App\Form\Country\CountryForm;
use App\ViewsBuilder\Adm\Messages\CountryMessage;
use App\ViewsBuilder\Adm\Pages\CountryPage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddController extends Controller
{

    public function get()
    {
        return $this->renderView();
    }

    public function post()
    {
        $form = new CountryForm('add');
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
        CountryFactory::get()->build($data);

        $this->flash->set('messages', [
            'class' => CountryMessage::class,
            'type'  => 'success_add_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('countries_list'));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new CountryPage($this->prepareData($data));
        return $pagina->add();
    }

}

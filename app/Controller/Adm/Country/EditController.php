<?php

namespace App\Controller\Adm\Country;

use App\Controller\Adm\Controller;
use App\Form\Country\CountryForm;
use App\ViewsBuilder\Adm\Messages\CountryMessage;
use App\ViewsBuilder\Adm\Pages\CountryPage;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EditController extends Controller
{

    public function get($country)
    {
        return $this->renderView($country->toArray());
    }

    public function post($country)
    {
        $form = new CountryForm('edit');

        $data = array_merge($country->toArray(), $this->request->request->all());
        $data = $form->filter($data);

        if (!$errors = $form->validate($data)) {
            // form success
            return $this->onFormSuccess($country, $data);
        }

        // form error
        return $this->renderView($data, $errors);
    }

    public function onFormSuccess($country, $data)
    {
       $country->edit($data);

        $this->flash->set('messages', [
            'class' => CountryMessage::class,
            'type'  => 'success_edit_message'
        ]);

        return new RedirectResponse($this->router->getUrlRequest('countries_edit', [
            'id' => $country->id
        ]));
    }

    public function renderView($data = [], $errors = [])
    {
        $data['errors'] = $errors;

        $pagina = new CountryPage($this->prepareData($data));
        return $pagina->edit();
    }

}

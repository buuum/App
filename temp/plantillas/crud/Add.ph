<?php

namespace App\Controller\{{scope}}\{{model}};

use App\Controller\{{scope}}\Controller;
use App\Form\{{model}}\FormAdd;

class Add extends Controller
{

    public function get()
    {
        $this->iniForm();
        return $this->renderView();
    }

    public function post()
    {
        $this->iniForm($this->request->request->all());

        if ($response = $this->form->post()) {
            return $response;
        }

        return $this->renderView();
    }

    public function iniForm($request = [])
    {
        $this->form = new FormAdd($this);
        $this->form->setRequest($request);
    }

    public function renderView()
    {
        return $this->render('itemadd', [
            'breadcrumb' => [
                'Home'          => $this->router->getUrlRequest('home'),
                '{{model}}' => $this->router->getUrlRequest('{{model_lower}}'),
                'Añadir'        => ''
            ],
            'form'   => $this->form->getForm()
        ]);
    }

}

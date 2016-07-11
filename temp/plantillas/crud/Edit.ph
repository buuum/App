<?php

namespace App\Controller\{{scope}}\{{model}};

use App\Controller\{{scope}}\Controller;
use App\Form\{{model}}\FormEdit;

class Edit extends Controller
{

    public function get($id)
    {
        $this->iniForm($id);
        return $this->renderView();
    }

    public function post($id)
    {
        $this->iniForm($id, $this->request->request->all());

        if ($response = $this->form->post()) {
            return $response;
        }

        return $this->renderView();
    }

    public function iniForm($id, $request = [])
    {
        $this->form = new FormEdit($this, $id);
        $this->form->setRequest($request);
    }

    public function renderView()
    {
        return $this->render('itemadd', [
            'breadcrumb' => [
                'Home'          => $this->router->getUrlRequest('home'),
                '{{model}}' => $this->router->getUrlRequest('{{model_lower}}'),
                'Editar'        => ''
            ],
            'form'   => $this->form->getForm()
        ]);
    }

}

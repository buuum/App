<?php

namespace App\Controller\{{scope}}\{{model}};

use App\Controller\{{scope}}\Controller;
use App\Form\{{model}}\FormDelete;

class Delete extends Controller
{

    public function get($id)
    {
        $this->iniForm($id);
        return $this->renderView();
    }

    public function post($id)
    {
        $this->iniForm($id, ['id' => $id]);

        if ($response = $this->form->post()) {
            return $response;
        }

        return $this->renderView();
    }

    public function iniForm($id, $request = [])
    {
        $this->form = new FormDelete($this, $id);
        $this->form->setRequest($request);
    }

    public function renderView()
    {
        $salida = [
            'error' => false,
            'html'  => $this->form->getForm()
        ];
        return json_encode($salida);
    }

}

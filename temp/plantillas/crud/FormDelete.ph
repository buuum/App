<?php

namespace App\Form\{{model}};

use App\Controller\AbstractController;
use App\Form\AbstractForm;
use App\Handler\{{model}}Handler;
use App\Validation\{{model}};

class FormDelete extends AbstractForm
{

    protected $id;

    public function __construct(AbstractController $controller, $id)
    {
        $this->controller = $controller;
        $this->id = $id;

        $this->handler = new {{model}}Handler();
        $this->validation = new {{model}}('delete');
        $this->extradata = $this->handler->getEditData($this->id);

        $this->action = $this->controller->router->getUrlRequest('delete{{model_lower}}', ['id' => $this->id]);
        $this->view = 'forms/{{model_lower}}/delete';
    }

    public function onFormSuccess()
    {
        $this->handler->delete($this->id);
    }

    public function onFormSuccessReturn()
    {
        return json_encode([
            'error' => false,
            'id'    => $this->id
        ]);
    }

}
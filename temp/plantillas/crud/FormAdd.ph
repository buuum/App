<?php

namespace App\Form\{{model}};

use App\Controller\AbstractController;
use App\Form\AbstractForm;
use App\Handler\{{model}}Handler;
use App\Validation\{{model}};
use Symfony\Component\HttpFoundation\RedirectResponse;

class FormAdd extends AbstractForm
{

    public function __construct(AbstractController $controller)
    {
        $this->controller = $controller;

        $this->handler = new {{model}}Handler();
        $this->validation = new {{model}}('add');
        $this->extradata = [];

        $this->action = $this->controller->router->getUrlRequest('add{{model_lower}}');
        $this->view = 'forms/{{model_lower}}/add';
    }

    public function onFormSuccess()
    {
        $this->handler->save($this->formdata);
    }

    public function onFormSuccessReturn()
    {
        return new RedirectResponse($this->controller->router->getUrlRequest('{{model_lower}}'));
    }

}
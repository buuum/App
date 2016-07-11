<?php

namespace App\Form\{{model}};

use App\Controller\AbstractController;
use App\Form\AbstractForm;
use App\Handler\{{model}}Handler;
use App\Validation\{{model}};
use Symfony\Component\HttpFoundation\RedirectResponse;

class FormEdit extends AbstractForm
{
    protected $id;

    public function __construct(AbstractController $controller, $id)
    {
        $this->controller = $controller;
        $this->id = $id;

        $this->handler = new {{model}}Handler();
        $this->validation = new {{model}}('edit');
        $this->extradata = $this->handler->getEditData($this->id);

        $this->action = $this->controller->router->getUrlRequest('edit{{model_lower}}', ['id' => $this->id]);
        $this->view = 'forms/{{model_lower}}/edit';
    }

    public function onFormSuccess()
    {
        $this->handler->edit($this->id, $this->formdata);
        $this->controller->flash->set($this->getName() . 'success', _e('Datos editados correctamente.'));
    }

    public function onFormSuccessReturn()
    {
        return new RedirectResponse($this->controller->router->getUrlRequest('edit{{model_lower}}', ['id' => $this->id]));
    }

}
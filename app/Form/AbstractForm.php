<?php

namespace App\Form;

use App\Controller\AbstractController;
use App\Support\DB;
use App\Validation\AbstractValidation;

abstract class AbstractForm
{

    /**
     * @var AbstractValidation
     */
    protected $validation;

    /**
     * @var array
     */
    protected $extradata = [];

    /**
     * @var array
     */
    protected $request = [];

    /**
     * @var mixed
     */
    protected $handler;

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * @var AbstractController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $view;

    /**
     * @var array
     */
    protected $formdata = false;

    /**
     * @var mixed
     */
    protected $errors = false;

    abstract public function onFormSuccess();

    abstract public function onFormSuccessReturn();

    public function setExtradata($extradata)
    {
        $this->extradata = $extradata;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function post()
    {
        $this->getData();
        if ($this->success()) {
            return $this->onSuccess();
        }

        return false;
    }

    protected function getData()
    {
        $this->formdata = $this->validation->filter($this->extradata, $this->request);
        if (!empty($this->request)) {
            $this->errors = $this->validation->validate($this->formdata);
        }
        return $this->formdata;
    }

    public function getForm()
    {
        $data = array_merge([
            'formdata' => $this->formdata ?: $this->getData(),
            'error'    => $this->errors,
            'action'   => $this->action,
            'success'  => ($msgs = $this->controller->flash->get($this->getName() . 'success')) ? implode('',
                $msgs) : false,
            'avisos'   => ($msgs = $this->controller->flash->get('avisos')) ? implode('', $msgs) : false
        ], $this->messages);

        return $this->controller->render($this->view, $data, false);
    }

    protected function onSuccess()
    {
        DB::beginTransaction();
        try {
            $this->onFormSuccess();
            DB::commit();
        } catch (\Exception $e) {
            $this->messages = ['error' => ['error' => [$e->getMessage()]]];
            DB::rollback();
            return false;
        }

        return $this->onFormSuccessReturn();
    }

    protected function success()
    {
        if (!empty($this->request) && !$this->errors) {
            return true;
        }

        return false;
    }

    protected function getName()
    {
        return get_called_class();
    }
}
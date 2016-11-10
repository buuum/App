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
     * Este variable sirve para sobreescribir los valores de extradata cuando el $_Post no existe.
     *
     * @var array
     */
    protected $multiplefields = [];

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

    public function renderForm($action, $view)
    {
        $data = array_merge([
            'formdata' => $this->formdata,
            'error'    => $this->errors,
            'action'   => $action,
            'success'  => ($msgs = $this->controller->flash->get($this->getName() . 'success')) ? implode('',
                $msgs) : false,
            'avisos'   => ($msgs = $this->controller->flash->get('avisos')) ? implode('', $msgs) : false
        ], $this->messages);

        return $this->controller->render($view, $data, false);
    }

    public function getForm()
    {
        if (!$this->formdata) {
            $this->getData();
        }
        return $this->renderForm($this->action, $this->view);
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

    protected function getData()
    {
        if (!empty($this->request)) {
            $this->errors = $this->validation->validate($this->request);
            $this->formdata = $this->validation->getMergeData($this->extradata, $this->validation->getData());
            $this->removeMultipleFields();
        } else {
            $this->formdata = $this->validation->getData($this->extradata);
        }
    }

    protected function success()
    {
        if (!empty($this->request) && !$this->errors) {
            return true;
        }

        return false;
    }

    protected function removeMultipleFields()
    {
        foreach ($this->multiplefields as $multiplefield) {
            if (!isset($this->request[$multiplefield])) {
                $this->formdata[$multiplefield] = '';
            }
        }
    }

    protected function getName()
    {
        return get_called_class();
    }
}
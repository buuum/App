<?php

namespace App\Form;

use App\Validation\AbstractValidation;

class FormHelper
{

    public $formdata;
    public $errors = false;

    /**
     * @var AbstractValidation
     */
    protected $validation;

    protected $initialdata = [];

    protected $data;

    public function __construct(AbstractValidation $validation, $data = false, $initialdata = [])
    {
        $this->data = $data;
        $this->validation = $validation;
        $this->initialdata = $initialdata;
        $this->getData();
    }

    public function getValidateData()
    {
        return $this->validation->getData($this->initialdata);
    }

    public function validate($data)
    {
        $this->errors = $this->validation->validate($data);

        return array_merge($this->initialdata, $data);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getData()
    {
        if (!empty($this->data)) {
            $this->formdata = $this->validate($this->data);
            $this->errors = $this->getErrors();
        } else {
            $this->formdata = $this->getValidateData();
        }
    }

    public function success()
    {
        if (!empty($this->data) && !$this->getErrors()) {
            return true;
        }

        return false;
    }

    public function getName()
    {
        return get_class($this->validation);
    }

}
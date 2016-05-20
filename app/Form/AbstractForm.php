<?php

namespace Application\Form;

use Application\Validation\AbstractValidation;

abstract class AbstractForm implements FormInterface
{

    protected $errors = false;
    /**
     * @var AbstractValidation
     */
    protected $validation;

    public function __construct($validation)
    {
        $this->validation = $validation;
    }

    public function getData()
    {
        $data = $this->getInitialData();
        return $this->validation->getData($data);
    }

    public function validate($data)
    {
        $this->errors = $this->validation->validate($data);

        if (!$this->errors) {
            return $this->run($data);
        }

        return $data;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}
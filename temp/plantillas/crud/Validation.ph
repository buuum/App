<?php

namespace App\Validation;

class {{model}} extends AbstractValidation
{

    public function __construct($type)
    {

        $filter_rules = [
            'nombre'      => 'trim|sanitize_string',
            'descripcion' => 'trim|custom_tags:<p>:<img>:<h1>:<span>:<strong>:<div>',
        ];
        $validated_rules = [
            'nombre'      => 'required',
            'descripcion' => ''
        ];

        $this->messages = [
            'required' => 'El campo :attribute es obligatorio.'
        ];

        $this->alias = [
        ];

        $this->types = [
            'add'    => ['nombre', 'descripcion'],
            'edit'   => ['nombre', 'descripcion'],
            'delete' => []
        ];

        $this->init($type, $filter_rules, $validated_rules);

    }
}
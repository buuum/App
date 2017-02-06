<?php

namespace App\Form\Rol;

use App\Form\AbstractForms;

class RolForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new RolFilter();
        $this->validation = new RolValidation();
    }

    public function relatedForms()
    {
        return [];
    }

    public function add()
    {
        return [
            'fields'            => ['rol'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => ['checkName']
        ];
    }

    public function edit()
    {
        return [
            'fields'            => ['rol'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => ['checkName']
        ];
    }

    public function addrelation()
    {
        return [
            'fields'            => ['roles_relation'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

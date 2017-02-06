<?php

namespace App\Form\User;

use App\Form\AbstractForms;
use App\Form\Country\CountryForm;
use App\Form\Pais\PaisForm;
use App\Form\Rol\RolForm;

class UserForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new UserFilter();
        $this->validation = new UserValidation();
    }

    public function relatedForms()
    {
        return [
            'pais_id'        => [
                'form_class'      => CountryForm::class,
                'relation_type'   => 'one',
                'validation_type' => [
                    'add'  => 'addrelation',
                    'edit' => 'addrelation'
                ]
            ],
            'roles_relation' => [
                'form_class'      => RolForm::class,
                'relation_type'   => 'onetomany',
                'validation_type' => [
                    'add'  => 'addrelation',
                    'edit' => 'addrelation'
                ]
            ],
        ];
    }

    public function login()
    {
        return [
            'fields'            => ['email', 'password'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => ['loginadmin']
        ];
    }

    public function add()
    {
        return [
            'fields'            => ['name', 'email', 'password', 'dia', 'mes', 'ano', 'gender', 'pseudo', 'estado'],
            'relations'         => ['roles_relation', 'pais_id'],
            'extra_filters'     => [],
            'extra_validations' => ['checkmail', 'checkedad']
        ];
    }

    public function edit()
    {
        return [
            'fields'            => ['name', 'email', 'dia', 'mes', 'ano', 'gender', 'pseudo', 'estado'],
            'relations'         => ['roles_relation', 'pais_id'],
            'extra_filters'     => [],
            'extra_validations' => ['checkmail', 'checkedad']
        ];
    }

    public function forgot()
    {
        return [
            'fields'            => ['email'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => ['checkforgotadmin']
        ];
    }

    public function reset_pass()
    {
        return [
            'fields'            => ['password', 'password2'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

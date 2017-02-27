<?php

namespace App\Form\User;

use App\Form\AbstractForms;
use App\Form\Country\CountryForm;
use App\Form\Pais\PaisForm;
use App\Form\Rol\RolForm;

class UserForm extends AbstractForms
{
    public function __construct($type, $type_variant = 'default')
    {
        $this->type = $type;
        $this->type_variant = $type_variant;
        $this->filter = new UserFilter();
        $this->validation = new UserValidation();
    }

    public function relatedForms()
    {
        return [
            'pais'  => [
                'form_class'      => CountryForm::class,
                'relation_type'   => 'one',
                'validation_type' => [
                    'add'  => 'addrelation',
                    'edit' => 'addrelation'
                ]
            ],
            'roles' => [
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
            'fields'            => [
                'name',
                'email',
                'birthday',
                'password',
                'gender',
                'pseudo',
                'estado',
                'roles',
                'pais'
            ],
            'relations'         => ['roles', 'pais'],
            'extra_filters'     => ['filterdate'],
            'extra_validations' => ['checkmail', 'checkedad']
        ];
    }

    public function edit()
    {
        return [
            'fields'            => ['name', 'email', 'birthday', 'gender', 'pseudo', 'estado', 'roles', 'pais'],
            'relations'         => ['roles', 'pais'],
            'extra_filters'     => ['filterdate'],
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
            'fields'            => ['pass', 'pass2'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

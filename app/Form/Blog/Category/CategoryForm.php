<?php

namespace App\Form\Blog\Category;

use App\Form\AbstractForms;

class CategoryForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new CategoryFilter();
        $this->validation = new CategoryValidation();
    }

    public function relatedForms()
    {
        return [
            'categoryparent' => [
                'form_class'      => CategoryForm::class,
                'relation_type'   => 'one',
                'validation_type' => [
                    'add'  => 'addparent',
                    'edit' => 'addparent'
                ]
            ],
        ];
    }

    public function add()
    {
        return [
            'fields'            => ['name'],
            'relations'         => ['categoryparent'],
            'extra_filters'     => [],
            'extra_validations' => ['checkName', 'checkurl']
        ];
    }

    public function edit()
    {
        return [
            'fields'            => ['name', 'url'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => ['checkName', 'checkurl']
        ];
    }

    public function addrelation()
    {
        return [
            'fields'            => ['id'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

    public function addparent()
    {
        return [
            'fields'            => ['id'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

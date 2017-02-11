<?php

namespace App\Form\Blog\Tag;

use App\Form\AbstractForms;

class TagForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new TagFilter();
        $this->validation = new TagValidation();
    }

    public function relatedForms()
    {
        return [];
    }

    public function add()
    {
        return [
            'fields'            => [],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

    public function edit()
    {
        return [
            'fields'            => [],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

    public function addrelation()
    {
        return [
            'fields'            => ['name'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

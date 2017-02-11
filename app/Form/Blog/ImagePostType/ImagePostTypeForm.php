<?php

namespace App\Form\Blog\ImagePostType;

use App\Form\AbstractForms;

class ImagePostTypeForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new ImagePostTypeFilter();
        $this->validation = new ImagePostTypeValidation();
    }

    public function relatedForms()
    {
        return [];
    }

    public function add()
    {
        return [
            'fields'            => ['type'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

    public function edit()
    {
        return [
            'fields'            => ['type'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
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

}

<?php

namespace App\Form\Media\MediaType;

use App\Form\AbstractForms;

class MediaTypeForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new MediaTypeFilter();
        $this->validation = new MediaTypeValidation();
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
            'fields'            => [],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

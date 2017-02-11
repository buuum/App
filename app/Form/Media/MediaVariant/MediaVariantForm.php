<?php

namespace App\Form\Media\MediaVariant;

use App\Form\AbstractForms;

class MediaVariantForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new MediaVariantFilter();
        $this->validation = new MediaVariantValidation();
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

}

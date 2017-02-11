<?php

namespace App\Form\Media\Media;

use App\Form\AbstractForms;

class MediaForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new MediaFilter();
        $this->validation = new MediaValidation();
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
            'fields'            => ['url'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

<?php

namespace App\Form\Blog\ImagePost;

use App\Form\AbstractForms;
use App\Form\Blog\ImagePostType\ImagePostTypeForm;
use App\Form\Media\Media\MediaForm;

class ImagePostForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new ImagePostFilter();
        $this->validation = new ImagePostValidation();
    }

    public function relatedForms()
    {
        return [
            'type'  => [
                'form_class'      => ImagePostTypeForm::class,
                'relation_type'   => 'one',
                'validation_type' => [
                    'add'  => 'addrelation',
                    'edit' => 'addrelation'
                ]
            ],
            'media' => [
                'form_class'      => MediaForm::class,
                'relation_type'   => 'one',
                'validation_type' => [
                    'add'         => 'addrelation',
                    'edit'        => 'addrelation',
                    'addrelation' => 'addrelation'
                ]
            ]
        ];
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
            'fields'            => [],
            'relations'         => ['media'],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

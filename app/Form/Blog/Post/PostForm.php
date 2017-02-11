<?php

namespace App\Form\Blog\Post;

use App\Form\AbstractForms;
use App\Form\Blog\Category\CategoryForm;
use App\Form\Blog\ImagePost\ImagePostForm;
use App\Form\Blog\Tag\TagForm;

class PostForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new PostFilter();
        $this->validation = new PostValidation();
    }

    public function relatedForms()
    {
        return [
            'categories' => [
                'form_class'      => CategoryForm::class,
                'relation_type'   => 'onetomany',
                'validation_type' => [
                    'add'  => 'addrelation',
                    'edit' => 'addrelation'
                ]
            ],
            'images'     => [
                'form_class'      => ImagePostForm::class,
                'relation_type'   => 'many',
                'validation_type' => [
                    'add'  => 'addrelation',
                    'edit' => 'addrelation'
                ]
            ],
            'tags'       => [
                'form_class'      => TagForm::class,
                'relation_type'   => 'many',
                'validation_type' => [
                    'add'  => 'addrelation',
                    'edit' => 'addrelation'
                ]
            ]
        ];
    }

    public function add()
    {
        return [
            'fields'            => ['title', 'text', 'publish_date'],
            'relations'         => ['categories', 'images', 'tags'],
            'extra_filters'     => [],
            'extra_validations' => ['checkUrl']
        ];
    }

    public function edit()
    {
        return [
            'fields'            => ['title', 'url', 'text', 'publish_date'],
            'relations'         => ['categories', 'images', 'tags'],
            'extra_filters'     => [],
            'extra_validations' => ['checkUrl']
        ];
    }

}

<?php

namespace App\Form\Blog\Post;

use App\Form\FilterInterface;

class PostFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'title'               => 'trim|sanitize_string',
            'text'                => 'trim|sanitize_string',
            'categories_relation' => 'trim'
        ];
    }

}
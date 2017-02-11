<?php

namespace App\Form\Blog\Category;

use App\Form\FilterInterface;

class CategoryFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'name' => 'trim|sanitize_string',
            'url'  => 'trim|sanitize_string'
        ];
    }

}
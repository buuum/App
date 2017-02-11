<?php

namespace App\Form\Blog\Tag;

use App\Form\FilterInterface;

class TagFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'name' => 'trim|sanitize_string'
        ];
    }

}
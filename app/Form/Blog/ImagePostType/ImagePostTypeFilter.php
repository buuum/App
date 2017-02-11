<?php

namespace App\Form\Blog\ImagePostType;

use App\Form\FilterInterface;

class ImagePostTypeFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'type'        => 'trim|sanitize_string',
            'description' => 'trim'
        ];
    }

}
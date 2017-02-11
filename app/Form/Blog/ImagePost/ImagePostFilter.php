<?php

namespace App\Form\Blog\ImagePost;

use App\Form\FilterInterface;

class ImagePostFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'url' => 'trim'
        ];
    }

}
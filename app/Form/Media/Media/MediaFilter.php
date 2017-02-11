<?php

namespace App\Form\Media\Media;

use App\Form\FilterInterface;

class MediaFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'url' => 'trim'
        ];
    }

}
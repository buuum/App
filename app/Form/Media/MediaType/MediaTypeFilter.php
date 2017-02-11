<?php

namespace App\Form\Media\MediaType;

use App\Form\FilterInterface;

class MediaTypeFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'field' => 'trim|sanitize_string'
        ];
    }

}
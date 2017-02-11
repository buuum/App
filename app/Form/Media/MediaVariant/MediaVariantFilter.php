<?php

namespace App\Form\Media\MediaVariant;

use App\Form\FilterInterface;

class MediaVariantFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'field' => 'trim|sanitize_string'
        ];
    }

}
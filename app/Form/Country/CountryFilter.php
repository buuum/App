<?php

namespace App\Form\Country;

use App\Form\FilterInterface;

class CountryFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'name'       => 'trim|sanitize_string',
            'iso_alpha2' => 'trim|sanitize_string',
            'iso_alpha3' => 'trim|sanitize_string'
        ];
    }

}
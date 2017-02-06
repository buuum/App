<?php

namespace App\Form\Rol;

use App\Form\FilterInterface;

class RolFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'rol' => 'trim|sanitize_string'
        ];
    }

}
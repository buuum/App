<?php

namespace App\Form\User;

use App\Form\FilterInterface;

class UserFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'email'     => 'trim|sanitize_string',
            'password'  => 'trim|sanitize_string',
            'password2' => 'trim|sanitize_string',
            'name'      => 'trim|sanitize_string',
            'surname'   => 'trim|sanitize_string',
            'dia'       => 'trim|sanitize_string',
            'mes'       => 'trim|sanitize_string',
            'ano'       => 'trim|sanitize_string',
            'sex'       => 'trim|sanitize_string',
            'pseudo'    => 'trim|sanitize_string'
        ];
    }

}
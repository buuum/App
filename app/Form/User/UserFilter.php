<?php

namespace App\Form\User;

use App\Form\FilterInterface;

class UserFilter implements FilterInterface
{

    public function getFilters()
    {
        return [
            'email'    => 'trim|sanitize_string',
            'password' => 'trim|sanitize_string',
            'pass'     => 'trim|sanitize_string',
            'pass2'    => 'trim|sanitize_string',
            'name'     => 'trim|sanitize_string',
            'surname'  => 'trim|sanitize_string',
            'birthday' => 'trim',
            'sex'      => 'trim|sanitize_string',
            'pseudo'   => 'trim|sanitize_string'
        ];
    }

    public function filterdate($data)
    {
        if (!empty($data['dia']) && !empty($data['mes']) && !empty($data['ano'])) {
            $data['birthday'] = $data['ano'] . '-' . $data['mes'] . '-' . $data['dia'];
        }
        return $data;
    }

}
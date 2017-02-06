<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\RolFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RolFilter extends Filter
{

    public function checkRol($id)
    {

        if (!$item = RolFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'rol' => $item
            ]
        ];
    }

}

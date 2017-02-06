<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\CountryFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CountryFilter extends Filter
{

    public function checkCountry($id)
    {

        if (!$item = CountryFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'country' => $item
            ]
        ];
    }

}

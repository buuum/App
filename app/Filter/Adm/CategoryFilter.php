<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\Blog\CategoryFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CategoryFilter extends Filter
{

    public function checkCategory($id)
    {

        if (!$item = CategoryFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'category' => $item
            ]
        ];
    }

}

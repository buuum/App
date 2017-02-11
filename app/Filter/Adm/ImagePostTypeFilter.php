<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\Blog\ImagePostTypeFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ImagePostTypeFilter extends Filter
{

    public function checkImagePostType($id)
    {

        if (!$item = ImagePostTypeFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'imageposttype' => $item
            ]
        ];
    }

}

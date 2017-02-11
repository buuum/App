<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\Blog\ImagePostFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ImagePostFilter extends Filter
{

    public function checkImagePost($id)
    {

        if (!$item = ImagePostFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'imagepost' => $item
            ]
        ];
    }

}

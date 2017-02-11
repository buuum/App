<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\Media\MediaFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MediaFilter extends Filter
{

    public function checkMedia($id)
    {

        if (!$item = MediaFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'media' => $item
            ]
        ];
    }

}

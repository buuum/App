<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\Media\MediaTypeFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MediaTypeFilter extends Filter
{

    public function checkMediaType($id)
    {

        if (!$item = MediaTypeFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'mediatype' => $item
            ]
        ];
    }

}

<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\Media\MediaVariantFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MediaVariantFilter extends Filter
{

    public function checkMediaVariant($id)
    {

        if (!$item = MediaVariantFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'mediavariant' => $item
            ]
        ];
    }

}

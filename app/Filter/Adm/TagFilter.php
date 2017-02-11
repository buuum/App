<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\Blog\TagFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TagFilter extends Filter
{

    public function checkTag($id)
    {

        if (!$item = TagFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'tag' => $item
            ]
        ];
    }

}

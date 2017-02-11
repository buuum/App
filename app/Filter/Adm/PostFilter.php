<?php

namespace App\Filter\Adm;

use App\Filter\Filter;
use App\Facades\Factory\Blog\PostFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PostFilter extends Filter
{

    public function checkPost($id)
    {

        if (!$item = PostFactory::get()->getEdit($id)) {
            return new RedirectResponse($this->router->getUrlRequest('home_adm'));
        }

        return [
            'passed'   => true,
            'response' => [
                'post' => $item
            ]
        ];
    }

}

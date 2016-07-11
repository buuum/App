<?php

namespace App\Controller\{{scope}}\{{model}};

use App\Controller\{{scope}}\Controller;
use App\Model\{{model_group}}{{model}};

class Home extends Controller
{
    public function get()
    {
        $fnurl = function ($item, $type) {
            $type .= '{{model_lower}}';
            return $this->router->getUrlRequest($type, ['id' => $item->id]);
        };

        return $this->render('itemlisttable', [
            'addurl'      => $this->router->getUrlRequest('add{{model_lower}}'),
            'addtext'     => _e('Add {{model}}'),
            'tablesort'   => false,
            'breadcrumb'  => [
                'Home'  => $this->router->getUrlRequest('home'),
                '{{model}}' => ''
            ],
            'titlestable' => [{{fields}}],
            'itemfields'  => [{{fields}}],
            'getUrl'     => $fnurl,
            'items'       => {{model}}::all()
        ]);
    }
}

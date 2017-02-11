<?php

namespace App\Controller\Adm\Media\MediaVariant;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Media\MediaVariantFactory;
use App\ViewsBuilder\Adm\Pages\MediaVariantPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new MediaVariantPage($this->prepareData([
            'mediasvariant' => MediaVariantFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}

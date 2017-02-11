<?php

namespace App\Controller\Adm\Media\Media;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Media\MediaFactory;
use App\ViewsBuilder\Adm\Pages\MediaPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new MediaPage($this->prepareData([
            'medias' => MediaFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}

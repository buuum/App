<?php

namespace App\Controller\Adm\Media\MediaType;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Media\MediaTypeFactory;
use App\ViewsBuilder\Adm\Pages\MediaTypePage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HomeController extends Controller
{

    public function get()
    {
        $page = new MediaTypePage($this->prepareData([
            'mediastype' => MediaTypeFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}

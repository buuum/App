<?php

namespace App\Controller\Adm\Blog\ImagePost;

use App\Controller\Adm\Controller;
use App\Facades\Handler\ImagePostHandler;
use App\ViewsBuilder\Adm\Pages\ImagePostPage;

class DeleteController extends Controller
{

    public function get($imagepost)
    {
        $pagina = new ImagePostPage($this->prepareData([
            'imagepost' => $imagepost
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($imagepost)
    {
        ImagePostHandler::get()->remove($imagepost);
        return [
            'error' => false,
            'id'    => $imagepost->id
        ];
    }

}

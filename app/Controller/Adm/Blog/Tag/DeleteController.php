<?php

namespace App\Controller\Adm\Blog\Tag;

use App\Controller\Adm\Controller;
use App\Facades\Handler\TagHandler;
use App\ViewsBuilder\Adm\Pages\TagPage;

class DeleteController extends Controller
{

    public function get($tag)
    {
        $pagina = new TagPage($this->prepareData([
            'tag' => $tag
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($tag)
    {
        TagHandler::get()->remove($tag);
        return [
            'error' => false,
            'id'    => $tag->id
        ];
    }

}

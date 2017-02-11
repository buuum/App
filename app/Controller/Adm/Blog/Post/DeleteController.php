<?php

namespace App\Controller\Adm\Blog\Post;

use App\Controller\Adm\Controller;
use App\Facades\Handler\PostHandler;
use App\ViewsBuilder\Adm\Pages\PostPage;

class DeleteController extends Controller
{

    public function get($post)
    {
        $pagina = new PostPage($this->prepareData([
            'post' => $post
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($post)
    {
        $post->delete();
        return [
            'error' => false,
            'id'    => $post->id
        ];
    }

}

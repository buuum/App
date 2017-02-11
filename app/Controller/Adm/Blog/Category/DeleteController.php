<?php

namespace App\Controller\Adm\Blog\Category;

use App\Controller\Adm\Controller;
use App\Facades\Handler\CategoryHandler;
use App\ViewsBuilder\Adm\Pages\CategoryPage;

class DeleteController extends Controller
{

    public function get($category)
    {
        $pagina = new CategoryPage($this->prepareData([
            'category' => $category
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($category)
    {
        $category->delete();
        return [
            'error' => false,
            'id'    => $category->id
        ];
    }

}

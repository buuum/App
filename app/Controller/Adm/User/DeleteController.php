<?php

namespace App\Controller\Adm\User;

use App\Controller\Adm\Controller;
use App\Facades\Handler\UserHandler;
use App\ViewsBuilder\Adm\Pages\UserPage;

class DeleteController extends Controller
{

    public function get($user)
    {
        $pagina = new UserPage($this->prepareData([
            'user' => $user
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($user)
    {
        $user->delete();
        return [
            'error' => false,
            'id'    => $user->id
        ];
    }

}

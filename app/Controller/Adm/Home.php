<?php

namespace App\Controller\Adm;

//http://www.theme-guys.com/materialism/html/forms-basic.html?optionsRadios=option1#
//http://fezvrasta.github.io/bootstrap-material-design/#getting-started

use App\ViewsBuilder\Adm\Pages\HomePage;

class Home extends Controller
{
    public function get()
    {
        $home = new HomePage($this->prepareData([
            'total_users' => 100
        ]));
        return $home->home();

    }

}

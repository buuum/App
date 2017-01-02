<?php

namespace App\Controller\Web;

class Home extends Controller
{
    public function get()
    {
        $home = new \App\ViewsBuilder\Home();
        return $home->showHome();
    }

}

<?php

namespace App\Controller\Web;

use App\ViewsBuilder\Web\Pages\HomePage;

class Home extends Controller
{
    public function get()
    {
        $page = new HomePage();
        return $page->home();
    }

}

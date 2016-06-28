<?php

namespace App\Controller\Web;

class Home extends Controller
{
    public function get()
    {
        $title = htmlentities("<Buuum/>");
        $quote = "Sólo hay dos cosas que sobrevivirían a un holocausto nuclear: las cucarachas y la ñapa \"temporal\" que metiste para solucionar ese bug.";
        return $this->render('index', compact("title", "quote"));
    }

}

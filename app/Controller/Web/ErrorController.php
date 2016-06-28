<?php

namespace App\Controller\Web;

use Symfony\Component\HttpFoundation\Response;

class ErrorController extends Controller
{
    public function error404()
    {
        $title = "Página no encotrada";
        $quote = "Soy tan despistado que no sé si he perdido el perro o me he encontrado una correa.";
        return new Response($this->render('errors/404', array('error' => 404, 'title' => $title, 'quote' => $quote),
            'layouterror'), 404);
    }

    public function error405()
    {
        $title = "Página no encotrada";
        $quote = "Soy tan despistado que no sé si he perdido el perro o me he encontrado una correa.";
        return new Response($this->render('errors/404', array('error' => 405, 'title' => $title, 'quote' => $quote),
            'layouterror'), 405);
    }

    public function error500(\Exception $e = null)
    {
        $title = "Página no encotrada";
        $quote = "Soy tan despistado que no sé si he perdido el perro o me he encontrado una correa.";
        return new Response($this->render('errors/500', array('error' => 500, 'title' => $title, 'quote' => $quote),
            'layouterror'), 500);
    }
}

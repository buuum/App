<?php

namespace App\Controller\Web;

use Symfony\Component\HttpFoundation\Response;

class ErrorController extends Controller
{
    public function error404()
    {
        return new Response( $this->getViewError([
                    'error' => $this->render('errors/404', array('error' => 404), false)
                ]), 404);
    }

    public function error405()
    {
        return new Response($this->getViewError([
                $this->render('errors/404', array('error' => 405), false)
                ]), 405);
    }

    public function error500(\Exception $e = null)
    {
        return new Response( $this->getViewError([
                    'error' =>$this->render('errors/500', array('error' => 500), false)
                ]), 500);
    }

    public function getViewError($params = []){
        return $this->render('errors/error', $params,
            'layout');
    }
}

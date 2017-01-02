<?php

namespace App\Controller\Web;

use App\Controller\AbstractController;

class Controller extends AbstractController
{

    protected $scope;
    protected $platform;

    public function initialize()
    {
        $this->scope = $this->config->get('environment.scope');
        $this->platform = $this->config->get('environment.platform');
    }

    protected function getError($type)
    {
        $error = new ErrorController($this->container);
        if ($type == 404) {
            return $error->error404();
        }

        return $error->error405();
    }

}

<?php

namespace Application\Controller\Web;

use Application\Controller\AbstractController;

class Controller extends AbstractController
{

    public function iniController()
    {

        $this->header
            ->title('Buuum')
            ->description('Skeleton App')
            ->keywords('')
            ->plugins(array('jquery', 'bootstrap'));
    }

}
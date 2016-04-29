<?php

namespace Application\Controller\Web;

use Application\Controller\AbstractController;

class Controller extends AbstractController
{
    protected $langs;

    public function iniController()
    {

        $this->scope = 'Web';

        $this->header
            ->title('Buuum')
            ->description('Skeleton App')
            ->keywords('')
            ->plugins(array('jquery', 'bootstrap'));
    }

}
<?php

namespace App\ViewsBuilder\Web;

class View extends \App\ViewsBuilder\View
{

    protected function defaultHeader()
    {
        $this->getView()->header
            ->title('Web')
            ->description('Web')
            ->keywords('')
            ->plugins([
                'jquery',
                'bootstrap',
                'font-awesome'
            ]);
    }

}
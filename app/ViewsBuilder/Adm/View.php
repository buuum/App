<?php

namespace App\ViewsBuilder\Adm;

class View extends \App\ViewsBuilder\View
{

    protected function defaultHeader()
    {
        $this->getView()->header
            ->title('Admin')
            ->description('Admin')
            ->keywords('')
            ->plugins([
                'jquery',
                'tether',
                'bootstrap',
                'font-awesome',
                'datatables',
                'bootstrap-material-design',
                'buuummodal'
            ]);
    }

}
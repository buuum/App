<?php

namespace App\ViewsBuilder\Adm;

class View extends \App\ViewsBuilder\View
{

    protected static $translates = [
        'pages/home' => [
            'en_EN' => 'pages/home_en'
        ]
    ];

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
                'buuummodal',
                'moment',
                'eonasdan-bootstrap-datetimepicker',
                'summernote',
                'liteUpload'
            ]);
    }


    protected static function translateView($view)
    {
        $lang = self::$config->get('environment.lang');

        if (!empty(self::$translates[$view]) && !empty(self::$translates[$view][$lang])) {
            $view = self::$translates[$view][$lang];
        }

        return $view;
    }
}
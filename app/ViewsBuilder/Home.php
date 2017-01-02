<?php

namespace App\ViewsBuilder;

class Home extends View
{
    public function showHome()
    {
        $home = $this->render('index', []);

        return $this->render('layout_page', [
            'page' => $home
        ]);

    }
}
<?php

namespace App\Controller\Adm\Country;

use App\Controller\Adm\Controller;
use App\Facades\Handler\CountryHandler;
use App\ViewsBuilder\Adm\Pages\CountryPage;

class DeleteController extends Controller
{

    public function get($country)
    {
        $pagina = new CountryPage($this->prepareData([
            'country' => $country
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($country)
    {
        CountryHandler::get()->remove($country);
        return [
            'error' => false,
            'id'    => $country->id
        ];
    }

}

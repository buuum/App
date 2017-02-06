<?php

namespace App\Handler;

use App\Handler\BaseHandler;
use App\Model\CountryModel;

class CountryHandler extends BaseHandler
{
    public function __construct()
    {
        parent::__construct(new CountryModel());
    }

    public function edit(CountryModel $country, $data)
    {
        $country->update($data);
    }

}

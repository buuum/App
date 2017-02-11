<?php

namespace App\Handler;

use App\Model\CountryModel;

class CountryHandler extends AbstractHandler
{

    public function __construct(CountryModel $rol)
    {
        $this->model = $rol;
    }

    public function create($data)
    {
        $this->model->name = $data['name'];
        $this->model->iso_alpha2 = $data['iso_alpha2'];
        $this->model->iso_alpha3 = $data['iso_alpha3'];
        $this->model->save();
    }

    public function edit($data)
    {
        $this->model->name = $data['name'];
        $this->model->iso_alpha2 = $data['iso_alpha2'];
        $this->model->iso_alpha3 = $data['iso_alpha3'];
        $this->model->update();
    }

}

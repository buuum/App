<?php

namespace App\Factory;

use App\Factory\AbstractFactory;
use App\Model\CountryModel;

class CountryFactory extends AbstractFactory
{
    public function __construct()
    {
        parent::__construct(new CountryModel());
    }

    public function getList()
    {
        return CountryModel::all();
    }

    public function getEdit($id)
    {
        return $this->model->find($id);
    }

    public function build($data)
    {
        $item = new CountryModel($data);
        $item->save();
    }

}
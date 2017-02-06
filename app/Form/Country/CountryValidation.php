<?php

namespace App\Form\Country;

use App\Form\ValidationInterface;
use App\Model\CountryModel;

class CountryValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'name'       => 'required',
            'iso_alpha2' => 'required',
            'iso_alpha3' => 'required',
            'pais_id'    => 'required'
        ];
    }

    public function getMessages()
    {
        return [
            'required' => _e('El campo :attribute es obligatorio.')
        ];
    }

    public function getAlias()
    {

        return [
            'field' => _e('Field')
        ];
    }

    public function checkName($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : 0;
        if ($rol = CountryModel::where('name', $data['name'])->where('id', '!=', $id)->first()) {
            return _e('Ya existe un pais con este nombre.');
        }

        return false;
    }

}
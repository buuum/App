<?php

namespace App\Form\Country;

use App\Form\AbstractForms;

class CountryForm extends AbstractForms
{
    public function __construct($type)
    {
        $this->type = $type;
        $this->filter = new CountryFilter();
        $this->validation = new CountryValidation();
    }

    public function relatedForms()
    {
        return [];
    }

    public function add()
    {
        return [
            'fields'            => ['name', 'iso_alpha2', 'iso_alpha3'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => ['checkName']
        ];
    }

    public function edit()
    {
        return [
            'fields'            => ['name', 'iso_alpha2', 'iso_alpha3'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => ['checkName']
        ];
    }

    public function addrelation()
    {
        return [
            'fields'            => ['pais_id'],
            'relations'         => [],
            'extra_filters'     => [],
            'extra_validations' => []
        ];
    }

}

<?php

namespace App\Form\Blog\Category;

use App\Form\ValidationInterface;
use App\Model\Blog\CategoryModel;

class CategoryValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'name'                => 'required',
            'url'                 => 'required',
            'categories_relation' => 'required'
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
            'name' => _e('Nombre')
        ];
    }

    public function checkName($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : 0;

        if ($rol = CategoryModel::where('name', $data['name'])->where('id', '!=', $id)->first()) {
            return _e('Ya existe una categoria con este nombre.');
        }

        return false;
    }

    public function checkurl($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : 0;
        $url = (!empty($data['url'])) ? $data['url'] : slugify($data['name']);

        if ($rol = CategoryModel::where('url', $url)->where('id', '!=', $id)->first()) {
            return _e('Ya existe una categoria con esta url.');
        }

        return false;
    }

}
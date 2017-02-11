<?php

namespace App\Form\Blog\Tag;

use App\Form\ValidationInterface;

class TagValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'name' => 'required'
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
            'name' => _e('Nombre del tag')
        ];
    }

}
<?php

namespace App\Form\Blog\ImagePostType;

use App\Form\ValidationInterface;

class ImagePostTypeValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'type'        => 'required',
            'description' => ''
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

}
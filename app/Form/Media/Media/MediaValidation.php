<?php

namespace App\Form\Media\Media;

use App\Form\ValidationInterface;

class MediaValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'url'          => 'required'
        ];
    }

    public function getMessages()
    {
        return [
            'required'                => _e('El campo :attribute es obligatorio.')
        ];
    }

    public function getAlias()
    {

        return [
            'field' => _e('Field')
        ];
    }

}
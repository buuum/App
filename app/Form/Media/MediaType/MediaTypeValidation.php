<?php

namespace App\Form\Media\MediaType;

use App\Form\ValidationInterface;

class MediaTypeValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'type' => 'required'
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
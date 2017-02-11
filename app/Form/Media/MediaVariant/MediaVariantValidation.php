<?php

namespace App\Form\Media\MediaVariant;

use App\Form\ValidationInterface;

class MediaVariantValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'field'          => 'required|alpha_numeric_space'
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
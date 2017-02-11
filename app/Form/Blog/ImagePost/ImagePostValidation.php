<?php

namespace App\Form\Blog\ImagePost;

use App\Form\ValidationInterface;

class ImagePostValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'url2' => 'required'
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
            'url' => _e('Url')
        ];
    }

}
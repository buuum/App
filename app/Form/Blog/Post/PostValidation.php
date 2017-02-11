<?php

namespace App\Form\Blog\Post;

use App\Form\ValidationInterface;
use App\Model\Blog\PostModel;

class PostValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'title'        => 'required',
            'text'         => 'required',
            'categories'   => 'required',
            'publish_date' => 'required',
            'images'       => 'required',
            'tags'         => 'required'

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
            'categories' => _e('Categorías')
        ];
    }

    public function checkurl($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : 0;
        $url = (!empty($data['url'])) ? $data['url'] : slugify($data['title']);

        if ($rol = PostModel::where('url', $url)->where('id', '!=', $id)->first()) {
            return _e('Ya existe un post con esta url.');
        }

        return false;
    }

}
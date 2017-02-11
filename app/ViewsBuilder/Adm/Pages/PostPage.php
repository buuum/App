<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class PostPage extends Page
{

    public function showlist()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'posts' => false
        ];

        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/posts/list', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function add()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'posts' => $this->getRoute()->getUrlRequest('posts_list'),
            'Add'   => false
        ];

        $this->data->categories = $this->parseOneToMany($this->data->categories);
        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/posts/add', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function edit()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'posts' => $this->getRoute()->getUrlRequest('posts_list'),
            'Edit'  => false
        ];

        $this->data->categories = $this->parseOneToMany($this->data->categories);
        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/posts/edit', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function delete()
    {
        $page = $this->render('pages/posts/delete', $this->data);
        return $this->renderModalBase($page);
    }

    public function image()
    {
        return $this->render('pages/posts/add_image', [
            'types' => $this->data->types
        ]);
    }
    public function tag()
    {
        return $this->render('pages/posts/add_tag');
    }

}
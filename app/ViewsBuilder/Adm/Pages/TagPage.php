<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class TagPage extends Page
{

    public function showlist()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'tags' => false
        ];

        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/tags/list', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function add()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'tags' => $this->getRoute()->getUrlRequest('tags_list'),
            'Add' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/tags/add', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function edit()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'tags' => $this->getRoute()->getUrlRequest('tags_list'),
            'Edit' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/tags/edit', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function delete()
    {
        $page = $this->render('pages/tags/delete', $this->data);
        return $this->renderModalBase($page);
    }

}
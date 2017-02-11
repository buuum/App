<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class ImagePostTypePage extends Page
{

    public function showlist()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'imagesposttypes' => false
        ];

        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/imagesposttypes/list', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function add()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'imagesposttypes' => $this->getRoute()->getUrlRequest('imagesposttypes_list'),
            'Add' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/imagesposttypes/add', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function edit()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'imagesposttypes' => $this->getRoute()->getUrlRequest('imagesposttypes_list'),
            'Edit' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/imagesposttypes/edit', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function delete()
    {
        $page = $this->render('pages/imagesposttypes/delete', $this->data);
        return $this->renderModalBase($page);
    }

}
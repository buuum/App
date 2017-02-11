<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class ImagePostPage extends Page
{

    public function showlist()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'imagespost' => false
        ];

        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/imagespost/list', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function add()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'imagespost' => $this->getRoute()->getUrlRequest('imagespost_list'),
            'Add' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/imagespost/add', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function edit()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'imagespost' => $this->getRoute()->getUrlRequest('imagespost_list'),
            'Edit' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/imagespost/edit', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function delete()
    {
        $page = $this->render('pages/imagespost/delete', $this->data);
        return $this->renderModalBase($page);
    }

}
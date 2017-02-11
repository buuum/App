<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class EscortPage extends Page
{

    public function showlist()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'escorts' => false
        ];

        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/escorts/list', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function add()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'escorts' => $this->getRoute()->getUrlRequest('escorts_list'),
            'Add' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/escorts/add', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function edit()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'escorts' => $this->getRoute()->getUrlRequest('escorts_list'),
            'Edit' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/escorts/edit', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function delete()
    {
        $page = $this->render('pages/escorts/delete', $this->data);
        return $this->renderModalBase($page);
    }

}
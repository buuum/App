<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class MediaVariantPage extends Page
{

    public function showlist()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'mediasvariant' => false
        ];

        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/mediasvariant/list', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function add()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'mediasvariant' => $this->getRoute()->getUrlRequest('mediasvariant_list'),
            'Add' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/mediasvariant/add', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function edit()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'mediasvariant' => $this->getRoute()->getUrlRequest('mediasvariant_list'),
            'Edit' => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/mediasvariant/edit', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function delete()
    {
        $page = $this->render('pages/mediasvariant/delete', $this->data);
        return $this->renderModalBase($page);
    }

}
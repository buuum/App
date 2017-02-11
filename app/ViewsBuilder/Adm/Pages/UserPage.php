<?php

namespace App\ViewsBuilder\Adm\Pages;

use App\ViewsBuilder\Adm\Page;

class UserPage extends Page
{

    public function login()
    {
        $this->simpleHeader('Admin', 'Admin');

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/users/login', $this->data);

        return $this->renderLayout('layouts/center_box', $page);
    }

    public function forgot()
    {
        $this->simpleHeader('Admin', 'Admin');

        $this->data->errors = $this->printErrors($this->data->errors);
        $page = $this->render('pages/users/forgot', $this->data);

        return $this->renderLayout('layouts/center_box', $page);
    }

    public function setpassword()
    {
        $this->simpleHeader('Admin', 'Admin');

        $this->data->errors = $this->printErrors($this->data->errors);
        $page = $this->render('pages/users/setpassword', $this->data);

        return $this->renderLayout('layouts/center_box', $page);
    }

    public function showlist()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'users' => false
        ];

        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $page = $this->render('pages/users/list', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function add()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'users' => $this->getRoute()->getUrlRequest('users_list'),
            'Add'   => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $data = [
            'dias'  => range(1, 31),
            'meses' => range(1, 12),
            'anos'  => array_reverse(range(date('Y') - 100, date('Y'))),
            'dia'   => !empty($this->data->birthday) ? date('j', strtotime($this->data->birthday)) : 0,
            'mes'   => !empty($this->data->birthday) ? date('n', strtotime($this->data->birthday)) : 0,
            'ano'   => !empty($this->data->birthday) ? date('Y', strtotime($this->data->birthday)) : 0,
        ];

        $this->data->roles = $this->parseOneToMany($this->data->roles);

        $this->data = (object)array_merge((array)$this->data, $data);

        $page = $this->render('pages/users/add', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function edit()
    {
        $this->simpleHeader('Admin', 'Admin');

        $breadcrumb = [
            'users' => $this->getRoute()->getUrlRequest('users_list'),
            'Edit'  => false
        ];

        $this->data->errors = $this->printErrors($this->data->errors);
        $this->data->messages = $this->printMessages($this->data->flash_vars);

        $data = [
            'dias'  => range(1, 31),
            'meses' => range(1, 12),
            'anos'  => array_reverse(range(date('Y') - 100, date('Y'))),
            'dia'   => !empty($this->data->birthday) ? date('j', strtotime($this->data->birthday)) : 0,
            'mes'   => !empty($this->data->birthday) ? date('n', strtotime($this->data->birthday)) : 0,
            'ano'   => !empty($this->data->birthday) ? date('Y', strtotime($this->data->birthday)) : 0,
        ];
        $this->data->roles = $this->parseOneToMany($this->data->roles);
        $this->data = (object)array_merge((array)$this->data, $data);

        $page = $this->render('pages/users/edit', $this->data);

        return $this->renderLayoutBase($this->data->usersingin, $breadcrumb, $page);
    }

    public function delete()
    {
        $page = $this->render('pages/users/delete', $this->data);
        return $this->renderModalBase($page);
    }

}
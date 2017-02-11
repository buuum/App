<?php

namespace App\ViewsBuilder\Adm;

class Page extends View
{

    public function getMenu($user)
    {
        return $this->render('includes/sidebar', [
            'user' => $user
        ]);
    }

    public function getBreadCrumbTheme($breadcrumb = [])
    {
        return $this->render('includes/breadcrumb', [
            'links' => $breadcrumb
        ]);
    }

    public function renderLayoutBase($user, $breadcrumb, $page)
    {
        return $this->render('layouts/base', [
            'sidebar'    => $this->getMenu($user),
            'breadcrumb' => $this->getBreadCrumbTheme($breadcrumb),
            'page'       => $page
        ]);
    }

    public function renderModalBase($page)
    {
        return $this->render('layouts/modal_base', [
            "page" => $page
        ]);
    }

    public function printErrors($errors)
    {
        $showerrors = '';
        if (!empty($errors)) {
            $showerrors = $this->render('includes/errors', [
                'errors' => $errors
            ]);
        }

        return $showerrors;
    }

    public function printMessages($messages)
    {
        $showmessages = '';
        if (!empty($messages->messages)) {
            $class = $messages->messages->class;
            $fn = $messages->messages->type;
            $showmessages = $class::$fn();
        }

        return $showmessages;
    }

    protected function parseOneToMany($data)
    {
        $list = [];
        if (!empty($data)) {
            foreach ($data as $datum){
                $list[] = $datum->id;
            }
        }
        return $list;
    }

}
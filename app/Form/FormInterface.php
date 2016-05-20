<?php

namespace Application\Form;

interface FormInterface
{

    public function getInitialData();
    public function run($data);
}
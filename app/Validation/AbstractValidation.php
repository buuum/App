<?php

namespace App\Validation;

use Buuum\Filter;
use Buuum\Validation;

abstract class AbstractValidation
{

    protected $filter_rules = [];
    protected $validated_rules = [];
    protected $messages;
    protected $alias;
    private $data = null;
    protected $types = [];

    public function getData(array $data = null, $force = false)
    {
        if ($this->data && !$force) {
            return array_merge($this->getBasicData(), $this->data);
        } elseif ($data) {
            return array_merge($this->getBasicData(), $data);
        } else {
            return $this->getBasicData();
        }
    }

    public function validate(array $data)
    {
        $filter = new Filter($this->filter_rules);
        $this->data = $filter->filter($data);

        $validation = new Validation($this->validated_rules, $this->messages, $this->alias);

        if (!$data = $validation->validate($this->data)) {
            return $validation->getErrors();
        }

        return false;
    }

    private function getBasicData()
    {
        $data = [];
        foreach ($this->validated_rules as $key => $validated_rule) {
            $data[$key] = '';
        }
        return $data;
    }

    protected function init($type, $filter_rules, $validated_rules)
    {

        $this->filter_rules = array_filter($filter_rules, function($k) use ($type){
            return in_array($k, $this->types[$type]);
        }, ARRAY_FILTER_USE_KEY);

        $this->validated_rules = array_filter($validated_rules, function($k) use ($type){
            return in_array($k, $this->types[$type]);
        }, ARRAY_FILTER_USE_KEY);

    }

}
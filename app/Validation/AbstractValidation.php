<?php

namespace Application\Validation;

use Buuum\Filter;
use Buuum\Validation;

class AbstractValidation
{

    private $filter_rules = [];
    private $validated_rules = [];
    private $messages;
    private $alias;
    private $data = null;

    public function __construct($validated_rules, $filter_rules, $messages = null, $alias = null)
    {
        $this->validated_rules = $validated_rules;
        $this->filter_rules = $filter_rules;
        $this->messages = $messages;
        $this->alias = $alias;
    }

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
    }

    private function getBasicData()
    {
        $data = [];
        foreach ($this->validated_rules as $key => $validated_rule) {
            $data[$key] = '';
        }
        return $data;
    }

}
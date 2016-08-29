<?php

namespace App\Validation;

use Buuum\Filter;
use Buuum\Validation;

abstract class AbstractValidation
{

    protected $type;
    protected $filter_rules = [];
    protected $validated_rules = [];
    protected $messages;
    /**
     * @var mixed
     */
    protected $related_forms = false;
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
        $errors = [];
        $error = [];

        $validation = new Validation($this->validated_rules, $this->messages, $this->alias);

        if ($this->related_forms) {
            foreach ($this->related_forms as $name => $relation) {
                if(isset($relation['validation_type'][$this->type])){
                    $class = new $relation['validation_class']($relation['validation_type'][$this->type]);
                    if (isset($this->data[$name])) {
                        foreach ($this->data[$name] as $k => $v) {
                            if ($error_ = $class->validate($v)) {
                                $alias = (!empty($this->alias[$name])) ? $this->alias[$name] : $name;
                                $errors[$alias .' '. ($k+1)][$k] = $error_;
                            }
                        }
                    }
                }
            }
        }

        if (!$data = $validation->validate($this->data)) {
            $error = $validation->getErrors();
        }

        if (!empty($errors) || !empty($error)) {
            return array_merge($error, $errors);
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

    protected function init($type, $filter_rules, $validated_rules, $related_forms = false)
    {

        $this->filter_rules = array_filter($filter_rules, function ($k) use ($type) {
            return in_array($k, $this->types[$type]);
        }, ARRAY_FILTER_USE_KEY);

        $this->validated_rules = array_filter($validated_rules, function ($k) use ($type) {
            return in_array($k, $this->types[$type]);
        }, ARRAY_FILTER_USE_KEY);

        $this->type = $type;
        $this->related_forms = $related_forms;
    }

}
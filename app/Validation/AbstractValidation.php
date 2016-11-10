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
            return $this->mergeDatas($this->getBasicData(), $this->data);
        } elseif ($data) {
            return $this->mergeDatas($this->getBasicData(), $data);
        } else {
            return $this->getBasicData();
        }
    }

    public function getMergeData($extradata, $data)
    {
        $response = array_replace_recursive($extradata, $data);
        if ($this->related_forms) {
            foreach ($this->related_forms as $name => $relation) {
                if (in_array($name, $this->types[$this->type])) {
                    foreach ($data[$name] as $key => $relationdata) {
                        $response[$name][$key] = (isset($extradata[$name][$key])) ? array_merge($extradata[$name][$key],
                            $relationdata) : $relationdata;
                    }
                }
            }
        }
        return $response;
    }

    public function mergeDatas($data, $extradata)
    {
        return array_replace_recursive($data, $extradata);
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
                if (in_array($name, $this->types[$this->type])) {
                    if (!isset($relation['validation_type'][$this->type])) {
                        throw new \Exception("No esta definido 'validation_type  {$this->type}' para la relación $name");
                    }
                    $class = new $relation['validation_class']($relation['validation_type'][$this->type]);
                    $alias = (!empty($this->alias[$name])) ? $this->alias[$name] : $name;
                    if (isset($this->data[$name])) {
                        foreach ($this->data[$name] as $k => $v) {
                            if ($error_ = $class->validate($v)) {
                                $errors[$alias . ' ' . ($k + 1)][$k] = $error_;
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

    public function getBasicData()
    {
        $data = [];
        foreach ($this->validated_rules as $key => $validated_rule) {
            $data[$key] = '';
        }

        if ($this->related_forms) {
            foreach ($this->related_forms as $name => $relation) {
                if (in_array($name, $this->types[$this->type])) {
                    if (!isset($relation['validation_type'][$this->type])) {
                        throw new \Exception("No esta definido 'validation_type  {$this->type}' para la relación $name");
                    }
                    $class = new $relation['validation_class']($relation['validation_type'][$this->type]);
                    $datarelation = [];
                    $datarelation[$name][] = $class->getBasicData();
                    $data = array_replace_recursive($data, $datarelation);
                }
            }
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
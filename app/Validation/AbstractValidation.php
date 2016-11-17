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


    public function filter($extradata, $request, $removeempty = [])
    {

        $data = array_replace_recursive($this->getBasicData(), $extradata);
        if (!empty($request)) {
            $removeempty = (empty($removeempty)) ? array_diff_key($this->getBasicData(), $request) : $removeempty;
            $data = $this->getMergeData($data, $request);
        }

        $filter = new Filter($this->filter_rules);
        $data = $filter->filter($data);

        if ($this->related_forms) {
            foreach ($this->related_forms as $name => $relation) {
                if (in_array($name, $this->types[$this->type])) {
                    $nwr = new $relation['validation_class']($relation['validation_type'][$this->type]);
                    foreach ($data[$name] as $key => $relationdata) {
                        $remove = (!empty($request[$name])) ? array_diff_key($nwr->getBasicData(),
                            $request[$name][$key]) : [];
                        $data[$name][$key] = $nwr->filter([], $relationdata, $remove);
                    }
                }
            }
        }

        return $this->clean($data, $removeempty);
    }

    protected function clean($data, $remove)
    {
        if (!empty($remove)) {
            foreach ($remove as $key => $val) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    public function getMergeData($extradata, $data)
    {
        $response = array_merge($extradata, $data);
        if ($this->related_forms) {
            foreach ($this->related_forms as $name => $relation) {
                if (in_array($name, $this->types[$this->type]) && !empty($data[$name])) {
                    foreach ($data[$name] as $key => $relationdata) {
                        $response[$name][$key] = (isset($extradata[$name][$key])) ? array_merge($extradata[$name][$key],
                            $relationdata) : $relationdata;
                    }
                }
            }
        }
        return $response;
    }

    public function validate(array $data)
    {
        $this->data = $data;
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
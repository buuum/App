<?php

namespace App\Form;

use Buuum\Filter;
use Buuum\Validation;

abstract class AbstractForms
{

    protected $type;
    /**
     * @var FilterInterface
     */
    protected $filter;
    /**
     * @var ValidationInterface
     */
    protected $validation;

    abstract public function relatedForms();

    public function filter($data)
    {

        $types = $this->{$this->type}();

        $filter = new Filter($this->getFilters($types));
        $data = $filter->filter($data);

        if (!empty($types['relations'])) {

            $relations = $this->relatedForms();
            foreach ($types['relations'] as $relation_name) {
                /** @var AbstractForms $newr */
                $newr = new $relations[$relation_name]['form_class']($relations[$relation_name]['validation_type'][$this->type]);
                if ($relations[$relation_name]['relation_type'] == 'one') {
                    $filt = $newr->filter([
                        $relation_name => $data[$relation_name]
                    ]);
                    $data[$relation_name] = $filt[$relation_name];
                } elseif ($relations[$relation_name]['relation_type'] == 'onetomany') {
                    if (empty($data[$relation_name])) {
                        $data[$relation_name] = [];
                    }
                } else {
                    if (!empty($data[$relation_name])) {
                        foreach ($data[$relation_name] as $key => $relationdata) {
                            $data[$relation_name][$key] = $newr->filter($relationdata);
                        }
                    } else {
                        $data[$relation_name] = [];
                    }
                }
            }
        }

        if (!empty($types['extra_filters'])) {
            foreach ($types['extra_filters'] as $function) {
                $data = call_user_func([$this->filter, $function], $data);
            }
        }

        return $data;
    }

    public function validate($data)
    {
        $error = [];
        $errors = [];

        $types = $this->{$this->type}();
        $alias = $this->validation->getAlias();

        $validation = new Validation($this->getValidations($types),
            array_merge($this->defaultMessages(), $this->validation->getMessages()), $alias);

        if (!empty($types['relations'])) {
            $relations = $this->relatedForms();
            foreach ($types['relations'] as $relation_name) {
                /** @var AbstractForms $newr */
                $newr = new $relations[$relation_name]['form_class']($relations[$relation_name]['validation_type'][$this->type]);
                $alias = (!empty($alias[$relation_name])) ? $alias[$relation_name] : $relation_name;
                if ($relations[$relation_name]['relation_type'] == 'one') {
                    //$value = isset($data[$relation_name]) ? $data[$relation_name] : '';
                    $value = empty($data[$relation_name]) ? [] : [$relation_name => $data[$relation_name]];
                    //if ($error_ = $newr->validate($value)) {
                    //    $errors[$alias][0] = $error_;
                    //}
                    if ($error_ = $newr->validate($value)) {
                        $errors[$alias] = $error_[$relation_name];
                    }
                } elseif ($relations[$relation_name]['relation_type'] == 'onetomany') {
                    $value = empty($data[$relation_name]) ? [] : [$relation_name => $data[$relation_name]];
                    if ($error_ = $newr->validate($value)) {
                        $errors[$alias] = $error_[$relation_name];
                    }
                } else {
                    $value = isset($data[$relation_name]) ? $data[$relation_name] : [];
                    foreach ($value as $k => $v) {
                        if ($error_ = $newr->validate($v)) {
                            $errors[$alias . ' ' . ($k + 1)][0] = $error_;
                        }
                    }
                }
            }
        }

        if (!$validation_data = $validation->validate($data)) {
            $error = $validation->getErrors();
        }

        if (!empty($errors) || !empty($error)) {
            return array_merge($error, $errors);
        }

        if (!empty($types['extra_validations'])) {
            $errors = [];
            foreach ($types['extra_validations'] as $function) {
                if ($error = call_user_func([$this->validation, $function], $data)) {
                    $errors[] = $error;
                }
            }
            if (!empty($errors)) {
                return $errors;
            }
        }

        return false;
    }

    protected function getFilters($types)
    {
        $fields = $types['fields'];

        return array_filter($this->filter->getFilters(), function ($k) use ($fields) {
            return in_array($k, $fields);
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function getValidations($types)
    {
        $fields = $types['fields'];

        return array_filter($this->validation->getValidations(), function ($k) use ($fields) {
            return in_array($k, $fields);
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function defaultMessages()
    {
        return [
            'required'                => _e('El campo :attribute es obligatorio.'),
            'valid_email'             => _e('El campo :attribute tiene que ser un email válido.'),
            'equals'                  => _e('Las contraseñas no coinciden.'),
            'integer'                 => _e('El campo :attribute tiene que ser valido'),
            'groupdate'               => _e('La fecha seleccionada es incorrecta.'),
            'required:condiciones'    => _e('Tienes que aceptar las Condiciones generales y la Política de privacidad'),
            'only_alpha_numeric_dash' => _e('El campo :attribute solo puede contener letras, números y _')
        ];
    }


}

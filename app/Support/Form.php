<?php

namespace App\Support;

use App\Validation\AbstractValidation;

class Form
{
    /**
     * @var AbstractValidation
     */
    protected $validation;
    /**
     * @var mixed
     */
    protected $onSuccess;
    /**
     * @var mixed
     */
    protected $render;

    /**
     * Form constructor.
     * @param AbstractValidation $validation
     * @param $onSuccess
     * @param $render
     */
    public function __construct(AbstractValidation $validation, $onSuccess, $render)
    {

        $this->validation = $validation;
        $this->render = $this->checkMethod($render);
        $this->onSuccess = $this->checkMethod($onSuccess);

    }

    /**
     * @param array $request
     * @param array $extradata
     * @return mixed
     */
    public function process(array $request = [], array $extradata = [])
    {

        $filter = $this->validation->filter($extradata, $request);
        if (!empty($request)) {
            $errors = $this->validation->validate($filter);
            if (!$errors) {
                DB::beginTransaction();
                try {
                    $response = call_user_func($this->onSuccess, $filter);
                    DB::commit();
                    return $response;
                } catch (\Exception $e) {
                    $errors = ['error' => [$e->getMessage()]];
                    DB::rollback();
                }
            }
            return call_user_func($this->render, array_merge($filter, ['errors' => $errors]));
        }

        return call_user_func($this->render, $filter);
    }

    /**
     * @param $method
     * @return mixed
     */
    protected function checkMethod($method)
    {
        if (!is_callable($method)) {
            if (!is_array($method) || !method_exists($method[0], $method[1])) {
                throw new \InvalidArgumentException('onSuccess y render tienen que ser callables.');
            }
        }

        return $method;
    }
}
<?php

namespace App\Handler;


use App\Model\{{model_group}}{{model}};

class {{model}}Handler
{

    protected $model;

    public function __construct()
    {
        $this->model = new {{model}}();
    }

    public function getNewData()
    {
        return [
        ];
    }

    public function getEditData($id)
    {

        $item = $this->model->find($id);

        return [
            'id'          => $item->id,
            'nombre'      => $item->nombre,
            'descripcion' => $item->descripcion,
        ];
    }

    public function save($data)
    {
        //if ($this->model->where('nombre', '=', $data['nombre'])->first()) {
        //    throw new \Exception(_e('Ya existe un tipo pregunta con este nombre.'));
        //}

        $item = new {{model}}();
        $item->nombre = $data['nombre'];
        $item->descripcion = $data['descripcion'];
        $item->save();

    }

    public function edit($id, $data)
    {
        //if ($this->model->where('nombre', '=', $data['nombre'])->where('id', '!=', $id)->first()) {
        //    throw new \Exception(_e('Ya existe un tipo pregunta con este nombre.'));
        //}

        if (!$item = $this->model->find($id)) {
            throw new \Exception(_e('Este {{model}} no existe'));
        }

        $item->nombre = $data['nombre'];
        $item->descripcion = $data['descripcion'];
        $item->update();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        $item->delete();
    }
}
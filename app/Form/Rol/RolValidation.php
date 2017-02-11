<?php

namespace App\Form\Rol;

use App\Form\ValidationInterface;
use App\Model\RolModel;

class RolValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'id'             => 'required',
            'rol'            => 'required',
            'roles_relation' => 'required'
        ];
    }

    public function getMessages()
    {
        return [
            'required' => _e('El campo :attribute es obligatorio.')
        ];
    }

    public function getAlias()
    {

        return [
            'rol' => _e('Rol')
        ];
    }

    public function checkName($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : 0;
        if ($rol = RolModel::where('rol', $data['rol'])->where('id', '!=', $id)->first()) {
            return _e('Ya existe un rol con este nombre.');
        }

        return false;
    }

}
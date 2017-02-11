<?php

namespace App\Form\User;

use App\Form\ValidationInterface;
use App\Model\User;
use App\Model\UserModel;
use App\Support\AppSupport;

class UserValidation implements ValidationInterface
{
    public function getValidations()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|valid_email',
            'birthday' => 'required|date:Y-n-j',
            'password' => 'required',
            'pass'     => 'required',
            'pass2'    => 'required|equals:pass',
            'roles'    => 'required',
            'estado'   => 'required',
            'pais'     => 'required'
        ];
    }

    public function getMessages()
    {
        return [
            'required'    => _e('El campo :attribute es obligatorio.'),
            'valid_email' => _e('El campo :attribute tiene que ser un email válido.'),
            'equals'      => _e('Las contraseñas no coinciden'),
            'date'        => _e('El campo fecha es incorrecto')
        ];
    }

    public function getAlias()
    {

        return [
            'name'           => _e('Nombre'),
            'password'       => _e('Contraseña'),
            'pass'           => _e('Contraseña'),
            'pass2'          => _e('Contraseña'),
            'email'          => _e('Email'),
            'birthday'       => _e('Fecha nacimiento'),
            'roles_relation' => _e('Roles')
        ];
    }


    public function loginadmin($data)
    {
        if (!$user = UserModel::where('email', '=', $data['email'])->whereHas('roles', function ($query) {
            $query->where('rol', 'admin');
        })->first()
        ) {
            return _e('Usuario o contraseña incorrectos.');
        }

        if (!password_verify($data['password'], $user->password)) {
            return _e('Usuario o contraseña incorrectos.');
        }

        if ($user->estado == UserModel::ESTADO_BAJA) {
            return _e('Usuario o contraseña incorrectos.');
        }

        if ($user->estado == UserModel::ESTADO_PENDIENTE) {
            return _e('Tienes que validar el email.');
        }

        return false;
    }


    public function checkmail($data)
    {

        $id = (!empty($data['id'])) ? $data['id'] : 0;
        if ($user = UserModel::where('email', $data['email'])->where('id', '!=', $id)->first()) {
            return _e('Ya existe un usuario con este email.');
        }

        return false;

    }

    public function checkforgotadmin($data)
    {
        if (!$user = UserModel::where('email', $data['email'])->whereHas('roles', function ($query) {
            $query->where('rol', 'admin');
        })->first()
        ) {
            return _e('No existe ningún usuario con este email.');
        }

        return false;
    }

    public function checkedad($data)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $data['birthday']);
        $today = new \DateTime();
        $years = $today->diff($d);
        if ($years->format('%y') < 18) {
            return _e('No se pueden registrar menores de 18 años.');
        }

        return false;

    }

}
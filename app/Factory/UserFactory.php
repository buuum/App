<?php

namespace App\Factory;

use App\Model\UserModel;

class UserFactory extends AbstractFactory
{
    public function __construct()
    {
        parent::__construct(new UserModel());
    }

    public function getList()
    {
        return UserModel::all();
    }

    public function getEdit($id)
    {
        UserModel::$add_appends = ['roles_relation', 'pais_id', 'dia', 'mes', 'ano'];

        if (!$user = UserModel::with(['roles', 'country'])->where('id', $id)->first()) {
            return false;
        }

        return $user;
    }

    public function build($data)
    {
        $item = new UserModel($data);
        $item->save();
    }

    public function buildFromAdmin($data)
    {
        $date = $data['ano'] . '-' . $data['mes'] . '-' . $data['dia'];

        $user = new UserModel();
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->gender = $data['gender'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->birthday = $date;
        $user->pseudo = $data['pseudo'];
        $user->estado = $data['estado'];

        $user->country()->associate($data['pais_id']);
        $user->save();

        $user->roles()->attach($data['roles_relation']);

        return $user;
    }

}
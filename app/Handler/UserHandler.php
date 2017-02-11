<?php

namespace App\Handler;

use App\Model\UserModel;
use Buuum\Encoding\Encode;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session\Session;

class UserHandler extends AbstractHandler
{
    public function __construct(UserModel $user)
    {
        $this->model = $user;
    }

    public function addRoles($roles)
    {
        if (!empty($roles)) {
            $rols = [];
            foreach ($roles as $rol) {
                $rols[] = $rol['id'];
            }
            $this->model->roles()->sync($rols);
        } else {
            $this->model->roles()->detach();
        }
    }

    public function create($data)
    {
        //$date = $data['ano'] . '-' . $data['mes'] . '-' . $data['dia'];

        $this->model->name = $data['name'];
        $this->model->surname = $data['surname'];
        $this->model->gender = $data['gender'];
        $this->model->email = $data['email'];
        $this->model->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->model->birthday = $data['birthday'];
        $this->model->pseudo = $data['pseudo'];
        $this->model->estado = $data['estado'];
        $this->model->pais()->associate($data['pais']['id']);
        $this->model->save();

        $this->addRoles($data['roles']);
    }

    public function edit($data)
    {

        //$date = $data['ano'] . '-' . $data['mes'] . '-' . $data['dia'];

        $this->model->name = $data['name'];
        $this->model->surname = $data['surname'];
        $this->model->gender = $data['gender'];
        $this->model->email = $data['email'];
        if (!empty($data['password'])) {
            $this->model->password = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $this->model->birthday = $data['birthday'];
        $this->model->pseudo = $data['pseudo'];
        $this->model->estado = $data['estado'];

        $this->model->pais()->associate($data['pais']['id']);
        $this->model->save();

        $this->addRoles($data['roles']);

    }

    public function setSession(Session $session)
    {
        $session->set('login', true);
        $session->set('id', $this->model->id);
        $session->set('user', [
            'id'      => $this->model->id,
            'name'    => $this->model->name,
            'surname' => $this->model->surname,
            'email'   => $this->model->email
        ]);
    }

    public function setCookie($type)
    {
        $value = Encode::encode([
            'id' => $this->model->id
        ]);
        return new Cookie($type, $value, time() + (24 * 60 * 60 * 100));
    }

    public function setPassword($pass)
    {
        //$user = $this->model->where('email', $email)->first();
        $this->model->password = password_hash($pass, PASSWORD_DEFAULT);
        $this->model->update();
    }
}

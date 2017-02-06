<?php

namespace App\Handler;

use App\Model\UserModel;
use Buuum\Encoding\Encode;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session\Session;

class UserHandler extends BaseHandler
{
    public function __construct()
    {
        parent::__construct(new UserModel());
    }

    public function edit(UserModel $user, $data)
    {

        $date = $data['ano'] . '-' . $data['mes'] . '-' . $data['dia'];

        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->gender = $data['gender'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $user->birthday = $date;
        $user->pseudo = $data['pseudo'];
        $user->estado = $data['estado'];

        $user->country()->associate($data['pais_id']);
        $user->update();

        if (!empty($data['roles_relation'])) {
            $user->roles()->sync($data['roles_relation']);
        } else {
            $user->roles()->detach();
        }

    }

    public function setSession($user, Session $session)
    {
        $session->set('login', true);
        $session->set('id', $user->id);
        $session->set('user', [
            'id'      => $user->id,
            'name'    => $user->name,
            'surname' => $user->surname,
            'email'   => $user->email
        ]);
    }

    public function setCookie($user, $type)
    {
        $value = Encode::encode([
            'id' => $user->id
        ]);
        return new Cookie($type, $value, time() + (24 * 60 * 60 * 100));
    }

    public function setPasswordFromEmail($email, $pass)
    {
        $user = $this->model->where('email', $email)->first();
        $user->password = password_hash($pass, PASSWORD_DEFAULT);
        $user->update();
    }
}

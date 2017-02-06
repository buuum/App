<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolModel extends Model
{
    protected $table = 'rol';

    public function users()
    {
        return $this->belongsToMany(UserModel::class, 'user_has_rol', 'rol_id', 'user_id');
    }

}
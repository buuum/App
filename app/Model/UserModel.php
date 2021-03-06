<?php

namespace App\Model;

use App\Traits\ModelAppendTrait;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{

    use ModelAppendTrait;

    const ESTADO_BAJA = 0;
    const ESTADO_ALTA = 1;
    const ESTADO_PENDIENTE = 2;

    protected $table = 'user';

    public function roles()
    {
        return $this->belongsToMany(RolModel::class, 'user_has_rol', 'user_id', 'rol_id');
    }

    public function pais()
    {
        return $this->belongsTo(CountryModel::class, 'country_id');
    }

    public function getEdadAttribute()
    {
        $date = new \DateTime($this->birthday);
        $now = new \DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }

}

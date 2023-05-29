<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends RoleModel
{
    public $guarded = [];

    public function role_user()
    {
        return $this->hasMany(role_user::class,'role_id','id');
    }
}

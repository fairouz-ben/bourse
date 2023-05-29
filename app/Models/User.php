<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class User extends Authenticatable implements LaratrustUser, MustVerifyEmail
{
    use HasRolesAndPermissions;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_ar',
        'prenom_ar',
        'nom_fr',
        'prenom_fr',
        'phone',
        'date_nais',
        'relex_service_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function relex_service()
    {
        return $this->belongsTo(Relex_service::class,"relex_service_id","id");
    }

    public function candidat(): HasOne
    {
        return $this->hasOne(Candidat::class,"user_id", "id");
    }

    public function role_user()
    {
        return $this->hasMany(role_user::class,'user_id','id');
    }
    public function permission_user()
    {
        return $this->hasMany(permission_user::class,'user_id','id');
    }
}

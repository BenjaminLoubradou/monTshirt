<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // récupérer tous les roles des utilisateurs
    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    // Vérifier si un utilisateur a un role en particulier
    public function hasRole($role){
        if($this->roles()->where('nom','=',$role)->first()){
            return true;
        }else{
            return false;
        }
    }
}

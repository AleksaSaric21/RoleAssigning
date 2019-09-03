<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function authorizeWithRoles($roles)
    {
        if (is_array($roles)){
            return $this->hasRoles($roles) || abort(401, 'This action in unauthorized.');
        }
        return $this->hasRole($roles) || abort(401, 'This action in unauthorized.');
    }

    public function hasRoles($roles)
    {
        return null != $this->roles()->whereIn('name',$roles)->first();
    }

    public function hasRole($roles)
    {

        return null != $this->roles()->where('name',$roles)->first();
    }

    public function giveRole(Role $role)
    {
        return $this->roles()->save($role);
    }

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
}

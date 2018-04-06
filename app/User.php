<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'surname', 'patronymic', 'email', 'password', 'photo', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function resumes()
    {
        return $this->hasMany('App\Resume', 'user_id', 'id');
    }

    public function vacancies()
    {
        return $this->hasMany('App\Vacancy', 'user_id', 'id');
    }

    public function isCompany()
    {
        return (\Auth::check() && $this->role == 'company');
    }

    public function isWorker()
    {
        return (\Auth::check() && $this->role == 'worker');
    }
}

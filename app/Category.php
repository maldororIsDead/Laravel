<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $guarded = [];

    public function resumes()
    {
        return $this->hasMany('App\Resume');
    }

    public function vacancies()
    {
        return $this->hasMany('App\Vacancy');
    }
}

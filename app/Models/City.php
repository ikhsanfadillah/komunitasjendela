<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function userDetail()
    {
        return $this->hasMany('App\Model\UserDetail', 'city_id', 'id');
    }
}

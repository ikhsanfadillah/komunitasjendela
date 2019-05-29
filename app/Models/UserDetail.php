<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id','city_id','nik','phone','dob','join_dt','address'
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('App\Model\City', 'city_id', 'id');
    }
}

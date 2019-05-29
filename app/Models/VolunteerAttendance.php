<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerAttendance extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }
}

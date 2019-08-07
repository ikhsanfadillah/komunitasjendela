<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    static $eventDays = ['1' => 'Monday','2' => 'Tuesday','3' => 'Wednesday','4' => 'Thursday','5' => 'Friday','6' => 'Saturday','7' => 'Sunday'];

    protected $fillable = [
        'name', 'slug', 'time_type','day','date','time','description'
    ];
    public function photo(){
        return $this->morphOne('App\Models\Photo','photoable');
    }
}

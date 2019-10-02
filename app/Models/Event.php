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
    public static function rules($id = false,$merge=[]){
        return array_merge([
            'name' => "required",
            'slug' => "required",
            'latitude' => "required",
            'longitude' => "required",
            'time_type' => "required",
            'day' => "required_if:time_type,==,day",
            'date' => "required_if:time_type,==,date",
            'time' => "required",
            'description' => "nullable"
        ],$merge);
    }


    public function getLatAttribute($latitude)
    {
        return $this->attributes['lat'] = number_format($latitude, 7);
    }
    public function getLongAttribute($longitude)
    {
        return $this->attributes['long'] = number_format($longitude, 7);
    }

    public function photo(){
        return $this->morphOne('App\Models\Photo','photoable');
    }
}

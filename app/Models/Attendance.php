<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Attendance
 * @property integer $id
 * @property integer $user_id
 * @property integer $checker_id
 * @property integer subbranch_id
 * @property integer $status
 * @property string $date
 * @property string $time_in
 * @property string $time_out
 * @package App\Models
 */
class Attendance extends Model
{
    static $status = [
        '10' => ['text' => 'confirm', 'color' => 'yellow'],
        '30' => ['text' => 'present', 'color' => 'green'],
        '50' => ['text' => 'absent', 'color' => 'red'],
    ];

    const STATUS_PRESENT = 30;
    public $timestamps = false;

    public static function rules($id = false,$merge=[]){
        return array_merge([
            'subbranch'      => 'exists:subbranches,id',
        ],$merge);
    }
    /* RELATION SHIP */
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }
    // Relationships
    public function volunteer()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function checker()
    {
        return $this->belongsTo('App\Models\User', 'checker_id', 'id');
    }

    public function subbranch()
    {
        return $this->belongsTo('App\Models\Subbranch', 'subbranch_id', 'id');
    }

    public static function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}

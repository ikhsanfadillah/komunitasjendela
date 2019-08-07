<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VolunteerAttendance
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
class VolunteerAttendance extends Model
{
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
}

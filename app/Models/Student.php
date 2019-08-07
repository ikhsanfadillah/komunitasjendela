<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Wildside\Userstamps\Userstamps;

class Student extends Model
{
    use Notifiable, Userstamps;

    protected $softDelete = true;

    protected $fillable = [
        'subbranch_id', 'name', 'nickname', 'email','nik','phone', 'dob', 'join_dt','address',
        'religion','grade','schoolname','order','number_of_siblings'
    ];

    public static function rules($id = false,$merge=[]){
        return array_merge([
            'subbranch_id'  => 'required|exists:subbranches,id',
            'name'          => 'required',
            'nickname'      => 'nullable|unique:students,nickname,'.($id ?: ''),
            'phone'         => 'nullable|max:15',
            'join_dt'       => 'nullable|before:now|date_format:Y-m-d',
            'dob'           => 'nullable|before:now|date_format:Y-m-d',
            'address'       => 'nullable|max:255',
            'religion'      => 'nullable',
            'grade'         => 'nullable',
            'schoolname'    => 'nullable|max:120',
            'order'         => 'nullable|numeric',
            'number_of_siblings'=> 'nullable|numeric',

        ],$merge);
    }
    public function studentParents(){
        return $this->hasMany('App\Models\StudentParent', 'student_id', 'id');
    }
    public function subbranch(){
        return $this->belongsTo('App\Models\Subbranch', 'subbranch_id', 'id');
    }
    public function age(){
        return Carbon::parse($this->dob)->age;
    }
    public function photos(){
        return $this->morphMany('App\Models\Photo','photoable');
    }
}

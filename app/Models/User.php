<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Wildside\Userstamps\Userstamps;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Userstamps;

    protected $softDelete = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','isActive'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rules($id = false,$merge=[]){
        return array_merge([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.($id ?: ''),
            'password'  => 'string',
            'nik'       => 'nullable|numeric|digits:16',
            'phone'     => 'nullable|max:15',
            'city_id'   => 'nullable|exists:cities,id',
            'dob'       => 'nullable|before:now|date_format:Y-m-d',
            'join_dt'   => 'nullable|before:now|date_format:Y-m-d',
            'address'   => 'nullable|max:255'
        ],$merge);
    }

    public static $genderList = ['M' => 'Male', 'F' => 'Female'];
    public const GENDER_MALE = "M";
    public const GENDER_FEMALE = "F";

    // Relationships
    public function detail()
    {
        return $this->hasOne('App\Models\UserDetail','user_id','id');
    }

    public function userDetail()
    {
        return $this->hasMany('App\Model\VolunteerAttendance', 'user_id', 'id');
    }
}

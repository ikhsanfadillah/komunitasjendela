<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function subbranch(){
        return $this->hasMany('App\Models\Subbranch', 'branch_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subbranch extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'name','branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch','branch_id','id');
    }
}

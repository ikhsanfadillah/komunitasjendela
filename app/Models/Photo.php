<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Wildside\Userstamps\Userstamps;

class Photo extends Model
{
    use Notifiable, Userstamps;

    protected $softDelete = true;

    protected $fillable = ['photoable_id', 'photoable_type', 'filename'];

    public function photoable(){
        return $this->morphTo();
    }

}

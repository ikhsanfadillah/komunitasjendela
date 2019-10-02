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
class VolunteerAttendance extends Attendance
{

}

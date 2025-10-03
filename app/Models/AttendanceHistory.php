<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceHistory extends Model
{
    protected $table = 'attendance_history';
    protected $fillable = ['employee_id','attendance_id','date_attendance','attendance_type','description'];
    protected $casts = ['date_attendance'=>'datetime'];
}

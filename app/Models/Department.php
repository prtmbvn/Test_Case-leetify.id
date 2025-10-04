<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected $fillable = ['department_name', 'max_clock_in_time', 'max_clock_out_time'];

    protected $casts = [
        'max_clock_in_time'  => 'datetime:H:i:s',
        'max_clock_out_time' => 'datetime:H:i:s',
    ];
    public function getMaxClockInTimeOnlyAttribute()
    {
        return Carbon::parse($this->max_clock_in_time)->format('H:i');
    }
    public function getMaxClockOutTimeOnlyAttribute()
    {
        return Carbon::parse($this->max_clock_out_time)->format('H:i');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'department_id');
    }
}

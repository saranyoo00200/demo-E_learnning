<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleTime extends Model
{
    use HasFactory;
    protected $table = 'schedule_time';
    public $timestamps = false;
    protected $fillable = [
        'schedule_id',
        'schedule_title',
        'schedule_place',
        'schedule_subject',
        'schedule_startdate',
        'schedule_enddate',
        'schedule_starttime',
        'schedule_endtime',
        'teacher_id',
    ];
}

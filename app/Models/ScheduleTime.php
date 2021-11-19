<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ScheduleTime;
use Auth;
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
    public function checkschedule_time($input)
    {
      if (!empty($input['schedule_startdate'])) {
        list($d,$m,$y) = explode('/',$input['schedule_startdate']);
        $schedule_startdate = "{$d}-{$m}-".($y-543);
      }
      if (!empty($input['schedule_enddate'])) {
        list($d,$m,$y) = explode('/',$input['schedule_enddate']);
        $schedule_enddate = "{$d}-{$m}-".($y-543);
      }
      $schedule_starttime = $input['schedule_starttime'];
      $schedule_starttime = $input['schedule_endtime'];
      
      // $data = ScheduleTime::where('schedule_startdate',)
    }
}

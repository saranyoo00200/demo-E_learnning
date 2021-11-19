<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ScheduleRepeatday;
use Auth;
class ScheduleRepeatday extends Model
{
    use HasFactory;
    protected $table = 'schedule_repeatday';
    public $timestamps = false;
    protected $fillable = [
        'sr_id',
        'sr_repeatday',
        'schedule_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonSynch extends Model
{
    use HasFactory;
    protected $table = 'lesson_synch';
    public $timestamps = false;
    protected $fillable = [
        'sync_id',
        'lesson_id',
        'subject_id',
        'start_date',
        'end_date',
        'synch_starttime',
        'synch_endtime',
        'synch_amount',
        'teacher_id',
        'synch_status',
        'synch_url',
        'synch_password',
        'synch_openpost',
    ];

}

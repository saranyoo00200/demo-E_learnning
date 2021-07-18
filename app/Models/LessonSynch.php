<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonSynch extends Model
{
    use HasFactory;
    protected $table = 'lesson_synch';
    protected $fillable = [
        'sync_id',
        'lesson_id',
        'start_date',
        'end_date',
        'synch_time',
        'synch_amout',
        'teacher_id',
        'synch_status',
    ];

}

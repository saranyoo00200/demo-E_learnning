<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'lesson',
        'lessonName',
        'show_lesson',
        'vdo',
        'subject_id',
    ];
}

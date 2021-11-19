<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;
    protected $table = 'class_student';
    public $timestamps = false;
    protected $fillable = ['subject_id', 'class_id', 'sync_id', 'subject_id', 'user_id', 'student_status', 'count_progress', 'graduation_day'];
}

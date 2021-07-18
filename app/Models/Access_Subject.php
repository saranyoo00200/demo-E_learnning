<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access_Subject extends Model
{
    use HasFactory;
    protected $table = 'access_subjects';
    protected $fillable = [
        'access_id',
        'subject_id',
        'lesson_id',
        'status_access',
        'created_at',
        'updated_at',
        'user_id',
    ];
}

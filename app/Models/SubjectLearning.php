<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectLearning extends Model
{
    use HasFactory;

    protected $fillable = [
        'subjectId',
        'subjectName',
        'title',
        'schoolYear',
        'image',
        'subjectType',
        'show_subject',
    ];
}

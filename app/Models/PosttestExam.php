<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosttestExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'aq1',
        'aq2',
        'aq3',
        'aq4',
        'answer',
        'subject_id',
    ];
}

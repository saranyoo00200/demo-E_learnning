<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PretestScores extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'timer',
        'users_id',
        'subject_id'
    ];
}

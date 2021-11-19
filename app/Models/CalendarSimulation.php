<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarSimulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'simulation_id',
        'subject_id',
        'user_id',
        'sync_id',
        'created_at',
        'updated_at',
    ];
}

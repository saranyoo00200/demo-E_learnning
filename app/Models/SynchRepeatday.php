<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SynchRepeatday extends Model
{
    use HasFactory;
    protected $table = 'synch_repeatday';
    public $timestamps = false;
    protected $fillable = [
        'synch_rid',
        'synch_repeatday',
        'sync_id'
    ];
}

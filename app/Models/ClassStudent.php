<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;
    protected $table = 'class_student';
    public $timestamps = false;
    protected $fillable = [
      'class_id',
      'sync_id',
      'student_id',
      'student_status'
    ];

}

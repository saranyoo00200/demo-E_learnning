<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroductionContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'show_intro',
        'introduction_id'
    ];

}

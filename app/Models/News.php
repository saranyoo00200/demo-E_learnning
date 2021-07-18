<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    public $timestamps = true;
    protected $fillable = [
      'news_id',
      'news_title',
      'subject_id',
      'news_detail',
      'news_status',
      'news_photo',
      'created_at',
      'updated_at'
    ];
}

<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Booth extends Model
{
    protected $collection = 'trade_booths';
    protected $fillable = ['title', 'image_url', 'video_url', 'description', 'exhibition_id'];
}

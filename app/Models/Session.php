<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['title', 'video_url', 'time', 'exhibition_id'];
    //
}

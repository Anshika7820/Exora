<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Session extends Model
{
    protected $collection = 'auditorium_sessions';
    protected $fillable = ['title', 'video_url', 'time', 'exhibition_id'];
}

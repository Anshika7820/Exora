<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Exhibition extends Model
{
    protected $collection = 'hosted_exhibitions';
    protected $fillable = ['title', 'description', 'creator_id', 'views', 'hall', 'image_url'];
}

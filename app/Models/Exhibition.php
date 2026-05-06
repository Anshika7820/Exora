<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Exhibition extends Model
{
    protected $fillable = ['title', 'description', 'creator_id', 'views'];
}

<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['name', 'message', 'user_id'];
    //
}

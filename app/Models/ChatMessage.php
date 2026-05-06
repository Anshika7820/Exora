<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['user_id', 'user_name', 'message'];
    //
}

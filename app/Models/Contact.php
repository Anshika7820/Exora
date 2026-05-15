<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['subject', 'message', 'user_id', 'status'];
}

<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Booth extends Model
{
    protected $fillable = ['title', 'image_url', 'description', 'exhibition_id'];
    //
}

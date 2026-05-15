<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ExhibitItem extends Model
{
    protected $fillable = [
        'hall_id',
        'creator_id',
        'type', // 'image', 'video'
        'url',
        'title',
        'description',
        'x',
        'y',
        'z',
        'rotation_x',
        'rotation_y',
        'rotation_z',
        'scale'
    ];
}

<?php

namespace App\Models\classroomModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    use HasFactory;

    protected $fileable = [
        'author_id',
        'classroom',
        'level',
        'building',
        'slug'
    ];
}

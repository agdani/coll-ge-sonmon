<?php

namespace App\Models\roleModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    protected $fileable = [
        'role',
        'slug'
    ];
}

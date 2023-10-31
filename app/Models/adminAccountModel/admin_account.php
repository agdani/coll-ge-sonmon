<?php

namespace App\Models\adminAccountModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin_account extends Model
{
    use HasFactory;

    protected $fileable = [
        'author_id',
        'role_id',
        'fname',
        'lname',
        'email',
        'school',
        'phone',
        'address',
        'city',
        'fonction',
        'matricule',
        'admin_img',
        'status',
        'slug'
    ];
}

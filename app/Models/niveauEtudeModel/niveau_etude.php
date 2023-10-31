<?php

namespace App\Models\niveauEtudeModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class niveau_etude extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id',
        'niveau_etude',
        'slug'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory; 

    protected $fillable = [
        'nom',
        'adresse',
        'code_postal',
        'ville',
        'pays',
        'telephone',
        'email',
        'site_web',
        'objet_social',
        'description',
    ];
}

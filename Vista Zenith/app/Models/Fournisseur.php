<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenoms',
        'adresse',
        'telephone',
        'societe_id',
    ];

    
    public function societe()
    {
        return $this->belongsTo(Societe::class, 'societe_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'libelle',
        'stock',
        'prix_achat',
        'prix_vente',
        'categorie_id',
    ];


    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}

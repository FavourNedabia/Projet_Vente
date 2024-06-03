<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneVente extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'vente_id',
    ];


    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function vente()
    {
        return $this->belongsTo(Vente::class, 'vente_id');
    }
}

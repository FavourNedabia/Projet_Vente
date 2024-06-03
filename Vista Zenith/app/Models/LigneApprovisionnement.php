<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneApprovisionnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'approvisionnement_id',
    ];


    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function approvisionnement()
    {
        return $this->belongsTo(Approvisionnement::class, 'approvisionnement_id');
    }
}

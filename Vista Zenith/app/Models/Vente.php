<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'personnel_id',
        'status',
        'reste',
        'total',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function ligneVente()
    {
        return $this->hasMany(LigneVente::class, 'vente_id', 'id');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}

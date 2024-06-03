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
    ];


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }


    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}

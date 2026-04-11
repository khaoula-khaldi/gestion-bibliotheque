<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'isbn',
        'annee',
        'type',
        'description',
        'prix_achat',
        'prix_emprunt',
        'disponible',
        'quantite', 
        'auteur_id',
        'image'       
    ];

    public function auteur()
    {
        return $this->belongsTo(Auteur::class);
    }

    public function achats() {
        return $this->hasMany(Achat::class);
    }
}
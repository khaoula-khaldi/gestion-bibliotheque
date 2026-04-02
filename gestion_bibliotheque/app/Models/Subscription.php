<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['user_id', 
                            'type',
                            'date_debut',
                            'date_fin',
                            'statut'];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

}

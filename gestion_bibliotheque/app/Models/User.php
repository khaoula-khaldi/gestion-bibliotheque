<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Achat;
use App\Models\Emprunt;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    public function achats(){
        return $this->hasMany(Achat::class);
    }

    public function emprunts(){
        return $this->hasMany(Emprunt::class);
    }

    public function isAdmin(){
        return $this->role === 'admin';
    }


    // Fonction est ce que abonnment active ou non 
    public function isSubscribed() {
        return $this->subscriptions()
                    ->where('statut', 'actif')
                    ->where('date_fin', '>=', now())
                    ->exists();
    }
}

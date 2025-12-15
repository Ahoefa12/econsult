<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Pour l'authentification si le médecin se connecte
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Medecin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'telephone',
        'adresse_cabinet',
        'photo',
        'diplomes',
        'horaires_travail',
        'speciality_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'diplomes' => 'array',
        'horaires_travail' => 'array',
    ];

    public function speciality()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id');
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}
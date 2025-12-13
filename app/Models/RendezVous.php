<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
     use HasFactory;

    // protected $table = 'rendez_vous'; // Corrected to use default 'rendez_vouses'

    protected $fillable = [
        'patient_id',
        'medecin_id',
        'date_heure',
        'duree_minutes',
        'motif_consultation',
        'statut',
    ];

    protected $casts = [
        'date_heure' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
}

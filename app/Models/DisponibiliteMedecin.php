<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DisponibiliteMedecin extends Model
{
    use HasFactory;

    protected $table = 'disponibilites_medecins';

    protected $fillable = [
        'medecin_id',
        'date',
        'type',
        'heure_debut',
        'heure_fin',
        'motif',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Relation avec le médecin
     */
    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    /**
     * Scope pour filtrer par type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope pour filtrer par date
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }

    /**
     * Scope pour les dates futures
     */
    public function scopeFuture($query)
    {
        return $query->where('date', '>=', Carbon::today());
    }

    /**
     * Scope pour les congés
     */
    public function scopeConges($query)
    {
        return $query->where('type', 'conge');
    }

    /**
     * Vérifie si cette disponibilité couvre une heure spécifique
     */
    public function couvreHeure($heure)
    {
        if (!$this->heure_debut || !$this->heure_fin) {
            return true; // Toute la journée
        }

        return $heure >= $this->heure_debut && $heure < $this->heure_fin;
    }
}

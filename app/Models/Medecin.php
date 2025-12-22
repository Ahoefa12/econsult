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
        'specialite_id'
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

    public function disponibilites()
    {
        return $this->hasMany(DisponibiliteMedecin::class);
    }

    /**
     * Récupère les horaires de travail pour un jour spécifique
     */
    public function getHorairesJour($jourSemaine)
    {
        if (!$this->horaires_travail || !is_array($this->horaires_travail)) {
            return [];
        }

        $jours = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $jour = $jours[$jourSemaine];

        return $this->horaires_travail[$jour] ?? [];
    }

    /**
     * Vérifie si le médecin est disponible à une date/heure donnée
     */
    public function isDisponible($dateHeure, $dureeMinutes = 30)
    {
        $date = \Carbon\Carbon::parse($dateHeure);

        // Vérifier les exceptions (congés, fermetures)
        $exception = $this->disponibilites()
            ->forDate($date->toDateString())
            ->whereIn('type', ['conge', 'fermeture'])
            ->first();

        if ($exception) {
            // Si c'est toute la journée
            if (!$exception->heure_debut || !$exception->heure_fin) {
                return false;
            }
            // Si l'heure est dans la plage d'exception
            if ($exception->couvreHeure($date->format('H:i:s'))) {
                return false;
            }
        }

        // Vérifier les horaires de travail normaux
        $horaires = $this->getHorairesJour($date->dayOfWeek);
        if (empty($horaires)) {
            return false;
        }

        $heureActuelle = $date->format('H:i');
        $heureFin = $date->copy()->addMinutes($dureeMinutes)->format('H:i');

        $dansPlageHoraire = false;
        foreach ($horaires as $plage) {
            if ($heureActuelle >= $plage['debut'] && $heureFin <= $plage['fin']) {
                $dansPlageHoraire = true;
                break;
            }
        }

        if (!$dansPlageHoraire) {
            return false;
        }

        // Vérifier si un rendez-vous existe déjà
        return !$this->hasRendezVous($dateHeure, $dureeMinutes);
    }

    /**
     * Vérifie si un rendez-vous existe à cette date/heure
     */
    public function hasRendezVous($dateHeure, $dureeMinutes = 30)
    {
        $debut = \Carbon\Carbon::parse($dateHeure);
        $fin = $debut->copy()->addMinutes($dureeMinutes);

        return $this->rendezVous()
            ->where('statut', '!=', 'annule')
            ->where(function ($query) use ($debut, $fin) {
                $query->whereBetween('date_heure', [$debut, $fin])
                    ->orWhere(function ($q) use ($debut, $fin) {
                        $q->where('date_heure', '<=', $debut)
                            ->whereRaw('DATE_ADD(date_heure, INTERVAL duree_minutes MINUTE) > ?', [$debut]);
                    });
            })
            ->exists();
    }

    /**
     * Génère tous les créneaux disponibles pour une date donnée
     */
    public function getCreneauxDisponibles($date, $intervalMinutes = 30)
    {
        $date = \Carbon\Carbon::parse($date);
        $creneaux = [];

        $horaires = $this->getHorairesJour($date->dayOfWeek);
        if (empty($horaires)) {
            return [];
        }

        foreach ($horaires as $plage) {
            $debut = \Carbon\Carbon::parse($date->toDateString() . ' ' . $plage['debut']);
            $fin = \Carbon\Carbon::parse($date->toDateString() . ' ' . $plage['fin']);

            $current = $debut->copy();
            while ($current->lt($fin)) {
                $dateHeure = $current->copy();

                if ($this->isDisponible($dateHeure, $intervalMinutes)) {
                    $creneaux[] = [
                        'heure' => $dateHeure->format('H:i'),
                        'datetime' => $dateHeure->toDateTimeString(),
                        'disponible' => true
                    ];
                }

                $current->addMinutes($intervalMinutes);
            }
        }

        return $creneaux;
    }
}
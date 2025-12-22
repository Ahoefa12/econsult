<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medecin;
use App\Models\DisponibiliteMedecin;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Récupère les créneaux disponibles pour un médecin à une date donnée
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'date' => 'required|date',
        ]);

        $medecin = Medecin::findOrFail($request->medecin_id);
        $date = Carbon::parse($request->date);

        // Ne pas permettre de réserver dans le passé
        if ($date->isPast() && !$date->isToday()) {
            return response()->json([
                'success' => false,
                'message' => 'Impossible de réserver dans le passé',
                'creneaux' => []
            ]);
        }

        $creneaux = $medecin->getCreneauxDisponibles($date);

        return response()->json([
            'success' => true,
            'date' => $date->format('Y-m-d'),
            'medecin' => [
                'id' => $medecin->id,
                'nom' => $medecin->nom . ' ' . $medecin->prenom,
            ],
            'creneaux' => $creneaux
        ]);
    }

    /**
     * Vérifie la disponibilité d'un créneau spécifique
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'date_heure' => 'required|date',
            'duree_minutes' => 'nullable|integer|min:15|max:120',
        ]);

        $medecin = Medecin::findOrFail($request->medecin_id);
        $dateHeure = Carbon::parse($request->date_heure);
        $duree = $request->duree_minutes ?? 30;

        $disponible = $medecin->isDisponible($dateHeure, $duree);

        return response()->json([
            'success' => true,
            'disponible' => $disponible,
            'date_heure' => $dateHeure->format('Y-m-d H:i'),
            'message' => $disponible
                ? 'Créneau disponible'
                : 'Créneau non disponible'
        ]);
    }

    /**
     * Récupère tous les rendez-vous d'un médecin pour un mois donné
     */
    public function getMonthAppointments($medecinId, $year, $month)
    {
        $medecin = Medecin::findOrFail($medecinId);

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $appointments = $medecin->rendezVous()
            ->whereBetween('date_heure', [$startDate, $endDate])
            ->where('statut', '!=', 'annule')
            ->orderBy('date_heure')
            ->get();

        $exceptions = $medecin->disponibilites()
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        return response()->json([
            'success' => true,
            'medecin' => [
                'id' => $medecin->id,
                'nom' => $medecin->nom . ' ' . $medecin->prenom,
            ],
            'period' => [
                'start' => $startDate->format('Y-m-d'),
                'end' => $endDate->format('Y-m-d'),
            ],
            'appointments' => $appointments,
            'exceptions' => $exceptions,
        ]);
    }

    /**
     * Récupère les jours avec disponibilité pour un mois
     */
    public function getMonthAvailability(Request $request)
    {
        $request->validate([
            'medecin_id' => 'required|exists:medecins,id',
            'year' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $medecin = Medecin::findOrFail($request->medecin_id);
        $startDate = Carbon::create($request->year, $request->month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $availability = [];
        $current = $startDate->copy();

        while ($current->lte($endDate)) {
            $creneaux = $medecin->getCreneauxDisponibles($current);

            $availability[] = [
                'date' => $current->format('Y-m-d'),
                'day' => $current->day,
                'has_availability' => count($creneaux) > 0,
                'slots_count' => count($creneaux),
            ];

            $current->addDay();
        }

        return response()->json([
            'success' => true,
            'availability' => $availability
        ]);
    }
}

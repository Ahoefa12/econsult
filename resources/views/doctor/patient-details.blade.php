@extends('doctor.layout')

@section('title', 'Détails Patient')

@section('content')
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('doctor.patients') }}" class="btn btn-outline">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <!-- Patient Info Card -->
    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">
            <h3 class="card-title">Informations du patient</h3>
        </div>
        <div style="padding: 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div>
                    <div style="color: var(--secondary); font-size: 0.875rem; margin-bottom: 0.5rem;">Nom complet</div>
                    <div style="font-weight: 600; font-size: 1.125rem;">{{ $patient->prenom }} {{ $patient->nom }}</div>
                </div>
                <div>
                    <div style="color: var(--secondary); font-size: 0.875rem; margin-bottom: 0.5rem;">Email</div>
                    <div style="font-weight: 600;">{{ $patient->email }}</div>
                </div>
                <div>
                    <div style="color: var(--secondary); font-size: 0.875rem; margin-bottom: 0.5rem;">Téléphone</div>
                    <div style="font-weight: 600;">{{ $patient->telephone }}</div>
                </div>
                <div>
                    <div style="color: var(--secondary); font-size: 0.875rem; margin-bottom: 0.5rem;">Consultations</div>
                    <div style="font-weight: 600; color: var(--primary);">{{ $appointments->count() }} consultation(s)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointment History -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Historique des consultations</h3>
        </div>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Date & Heure</th>
                        <th>Motif</th>
                        <th>Durée</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $apt)
                        <tr>
                            <td>
                                <div style="font-weight: 600;">{{ $apt->date_heure->translatedFormat('d M Y') }}</div>
                                <div style="color: var(--secondary); font-size: 0.875rem;">{{ $apt->date_heure->format('H:i') }}
                                </div>
                            </td>
                            <td>{{ $apt->motif_consultation ?? 'Consultation générale' }}</td>
                            <td>{{ $apt->duree_minutes }} min</td>
                            <td>
                                <span class="status-badge 
                                    @if($apt->statut == 'confirme') status-success
                                    @elseif($apt->statut == 'en_attente') status-warning
                                    @else status-danger @endif">
                                    {{ ucfirst($apt->statut) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
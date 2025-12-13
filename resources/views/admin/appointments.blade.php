@extends('admin.layout')

@section('title', 'Gestion des Rendez-vous')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tous les rendez-vous</h3>
        <button class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau
        </button>
    </div>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Médecin</th>
                    <th>Date & Heure</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $apt)
                <tr>
                    <td>
                        <div style="font-weight: 500;">
                            {{ $apt->patient ? $apt->patient->nom . ' ' . $apt->patient->prenom : 'Client invité' }}
                            <br>
                            <span style="font-size: 0.8rem; color: #64748b;">{{ $apt->nom }} {{ $apt->prenom }}</span>
                        </div>
                    </td>
                    <td>{{ $apt->medecin ? $apt->medecin->nom . ' ' . $apt->medecin->prenom : 'Non assigné' }}</td>
                    <td>{{ $apt->date_heure->format('d/m/Y H:i') }}</td>
                    <td>{{ $apt->motif_consultation ?? 'Consultation' }}</td>
                    <td>
                        <span class="status-badge 
                            @if($apt->statut == 'confirme') status-success
                            @elseif($apt->statut == 'en_attente') status-warning
                            @elseif($apt->statut == 'annule') status-danger
                            @else status-neutral @endif">
                            {{ ucfirst($apt->statut) }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <button class="action-btn" title="Voir"><i class="fas fa-eye"></i></button>
                            <button class="action-btn" title="Éditer"><i class="fas fa-edit"></i></button>
                            <button class="action-btn" style="color: var(--danger);" title="Supprimer"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

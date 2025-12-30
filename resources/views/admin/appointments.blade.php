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
                                    {{ $apt->user ? $apt->user->nom . ' ' . $apt->user->prenom : 'Client invité' }}
                                    <br>

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
                                    @if($apt->statut == 'en_attente')
                                        <form action="{{ route('admin.appointments.confirm', $apt->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn" style="color: var(--success);"
                                                title="Confirmer et envoyer email">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.appointments.cancel', $apt->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn" style="color: var(--danger);"
                                                title="Annuler et envoyer email"
                                                onclick="return confirm('Annuler ce rendez-vous ?')">
                                                <i class="fas fa-times"></i> 
                                            </button>
                                        </form>
                                    @elseif($apt->statut == 'confirme')
                                        <span class="action-btn" style="color: var(--success); cursor: default;"
                                            title="Déjà confirmé">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                    @else
                                        <span class="action-btn" style="color: var(--secondary); cursor: default;" title="Annulé">
                                            <i class="fas fa-ban"></i>
                                        </span>
                                    @endif
                                    <button class="action-btn" title="Voir détails"><i class="fas fa-eye"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
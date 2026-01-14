@extends('admin.layout')

@section('title', 'Gestion des Rendez-vous')

@section('content')
    <style>
        .tabs-container {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e5e7eb;
            flex-wrap: wrap;
        }

        .tab {
            padding: 1rem 1.5rem;
            color: #6b7280;
            text-decoration: none;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tab:hover {
            color: #0EAD69;
            border-bottom-color: #0EAD69;
        }

        .tab.active {
            color: #0EAD69;
            border-bottom-color: #0EAD69;
        }

        .tab-badge {
            background: #f3f4f6;
            color: #6b7280;
            padding: 0.25rem 0.625rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .tab.active .tab-badge {
            background: #0EAD69;
            color: white;
        }
    </style>

    <!-- Onglets de filtrage -->
    <div class="tabs-container">
        <a href="{{ route('admin.appointments', ['status' => 'all']) }}"
            class="tab {{ (!isset($filter) || $filter === 'all') ? 'active' : '' }}">
            <i class="fas fa-list"></i> Tous
            <span class="tab-badge">{{ $stats['total'] }}</span>
        </a>
        <a href="{{ route('admin.appointments', ['status' => 'en_attente']) }}"
            class="tab {{ $filter === 'en_attente' ? 'active' : '' }}">
            <i class="fas fa-clock"></i> En attente
            <span class="tab-badge">{{ $stats['pending'] }}</span>
        </a>
        <a href="{{ route('admin.appointments', ['status' => 'confirme']) }}"
            class="tab {{ $filter === 'confirme' ? 'active' : '' }}">
            <i class="fas fa-check-circle"></i> Confirmés
            <span class="tab-badge">{{ $stats['confirmed'] }}</span>
        </a>
        <a href="{{ route('admin.appointments', ['status' => 'annule']) }}"
            class="tab {{ $filter === 'annule' ? 'active' : '' }}">
            <i class="fas fa-ban"></i> Annulés
            <span class="tab-badge">{{ $stats['cancelled'] }}</span>
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                @if($filter === 'en_attente')
                    Rendez-vous en attente
                @elseif($filter === 'confirme')
                    Rendez-vous confirmés
                @elseif($filter === 'annule')
                    Rendez-vous annulés
                @else
                    Tous les rendez-vous
                @endif
            </h3>
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
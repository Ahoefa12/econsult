@extends('doctor.layout')

@section('title', 'Mes Rendez-vous')

@section('content')
    <style>
        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--gray-300);
            background: white;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: var(--secondary);
            font-weight: 600;
        }

        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .filter-btn.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-color: var(--primary);
        }
    </style>

    <!-- Filters -->
    <div class="filters">
        <a href="{{ route('doctor.appointments') }}"
            class="filter-btn {{ !request('filter') && !request('status') ? 'active' : '' }}">
            <i class="fas fa-list"></i> Tous
        </a>
        <a href="{{ route('doctor.appointments', ['filter' => 'today']) }}"
            class="filter-btn {{ request('filter') == 'today' ? 'active' : '' }}">
            <i class="fas fa-calendar-day"></i> Aujourd'hui
        </a>
        <a href="{{ route('doctor.appointments', ['filter' => 'week']) }}"
            class="filter-btn {{ request('filter') == 'week' ? 'active' : '' }}">
            <i class="fas fa-calendar-week"></i> Cette semaine
        </a>
        <a href="{{ route('doctor.appointments', ['filter' => 'month']) }}"
            class="filter-btn {{ request('filter') == 'month' ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Ce mois
        </a>
        <div style="flex: 1"></div>
        <a href="{{ route('doctor.appointments', ['status' => 'en_attente']) }}"
            class="filter-btn {{ request('status') == 'en_attente' ? 'active' : '' }}">
            <i class="fas fa-clock"></i> En attente
        </a>
        <a href="{{ route('doctor.appointments', ['status' => 'confirme']) }}"
            class="filter-btn {{ request('status') == 'confirme' ? 'active' : '' }}">
            <i class="fas fa-check"></i> Confirmés
        </a>
    </div>

    <!-- Appointments Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liste des rendez-vous</h3>
        </div>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Date & Heure</th>
                        <th>Contact</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $apt)
                        <tr>
                            <td>
                                <div style="font-weight: 600;">{{ $apt->prenom }} {{ $apt->nom }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 600;">{{ $apt->date_heure->translatedFormat('d M Y') }}</div>
                                <div style="color: var(--secondary); font-size: 0.875rem;">{{ $apt->date_heure->format('H:i') }}
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.875rem;">
                                    <i class="fas fa-phone"></i> {{ $apt->telephone }}<br>
                                    <i class="fas fa-envelope"></i> {{ $apt->email }}
                                </div>
                            </td>
                            <td>{{ $apt->motif_consultation ?? 'Consultation' }}</td>
                            <td>
                                <span class="status-badge 
                                    @if($apt->statut == 'confirme') status-success
                                    @elseif($apt->statut == 'en_attente') status-warning
                                    @else status-danger @endif">
                                    {{ ucfirst($apt->statut) }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    @if($apt->statut == 'en_attente')
                                        <form action="{{ route('doctor.appointments.confirm', $apt->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn" style="color: var(--success);"
                                                title="Confirmer">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('doctor.appointments.cancel', $apt->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn" style="color: var(--danger);" title="Annuler"
                                                onclick="return confirm('Annuler ce rendez-vous ?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @elseif($apt->statut == 'confirme')
                                        <span class="action-btn" style="color: var(--success); cursor: default;" title="Confirmé">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                    @else
                                        <span class="action-btn" style="color: var(--secondary); cursor: default;" title="Annulé">
                                            <i class="fas fa-ban"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--secondary);">
                                <i class="fas fa-calendar-times"
                                    style="font-size: 3rem; opacity: 0.3; display: block; margin-bottom: 1rem;"></i>
                                Aucun rendez-vous trouvé
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($appointments->hasPages())
            <div style="padding: 1.5rem;">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
@endsection
@extends('doctor.layout')

@section('title', 'Tableau de bord')

@section('content')
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.primary {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stat-icon.warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .stat-icon.info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .stat-icon.success {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .stat-content h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .stat-content p {
            color: var(--secondary);
            font-size: 0.875rem;
        }

        .appointments-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 2rem;
        }

        @media (max-width: 1024px) {
            .appointments-section {
                grid-template-columns: 1fr;
            }
        }

        .appointment-item {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .appointment-item:last-child {
            border-bottom: none;
        }

        .appointment-info h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .appointment-info p {
            font-size: 0.875rem;
            color: var(--secondary);
        }

        .appointment-time {
            text-align: right;
        }

        .appointment-time .time {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--primary);
        }

        .appointment-time .date {
            font-size: 0.875rem;
            color: var(--secondary);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--secondary);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }
    </style>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['today'] }}</h3>
                <p>Rendez-vous aujourd'hui</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-calendar-week"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['this_week'] }}</h3>
                <p>Cette semaine</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['pending'] }}</h3>
                <p>En attente</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_patients'] }}</h3>
                <p>Patients total</p>
            </div>
        </div>
    </div>

    <!-- Appointments Sections -->
    <div class="appointments-section">
        <!-- Today's Appointments -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rendez-vous aujourd'hui</h3>
                <a href="{{ route('doctor.appointments', ['filter' => 'today']) }}" class="btn btn-outline">
                    Voir tout
                </a>
            </div>
            <div>
                @if($todayAppointments->count() > 0)
                    @foreach($todayAppointments as $apt)
                        <div class="appointment-item">
                            <div class="appointment-info">
                                <h4>{{ $apt->prenom }} {{ $apt->nom }}</h4>
                                <p>
                                    <i class="fas fa-phone"></i> {{ $apt->telephone }}
                                    @if($apt->motif_consultation)
                                        <br><i class="fas fa-notes-medical"></i> {{ Str::limit($apt->motif_consultation, 40) }}
                                    @endif
                                </p>
                            </div>
                            <div class="appointment-time">
                                <div class="time">{{ $apt->date_heure->format('H:i') }}</div>
                                <div class="date">
                                    <span class="status-badge 
                                                @if($apt->statut == 'confirme') status-success
                                                @elseif($apt->statut == 'en_attente') status-warning
                                                @else status-danger @endif">
                                        {{ ucfirst($apt->statut) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-calendar-check"></i>
                        <p>Aucun rendez-vous aujourd'hui</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Prochains rendez-vous</h3>
                <a href="{{ route('doctor.appointments') }}" class="btn btn-outline">
                    Voir tout
                </a>
            </div>
            <div>
                @if($upcomingAppointments->count() > 0)
                    @foreach($upcomingAppointments as $apt)
                        <div class="appointment-item">
                            <div class="appointment-info">
                                <h4>{{ $apt->prenom }} {{ $apt->nom }}</h4>
                                <p>
                                    <i class="fas fa-envelope"></i> {{ $apt->email }}
                                </p>
                            </div>
                            <div class="appointment-time">
                                <div class="time">{{ $apt->date_heure->format('H:i') }}</div>
                                <div class="date">{{ $apt->date_heure->translatedFormat('d M Y') }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Aucun rendez-vous à venir</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card" style="margin-top: 2rem;">
        <div class="card-header">
            <h3 class="card-title">Actions rapides</h3>
        </div>
        <div style="padding: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('doctor.appointments', ['status' => 'en_attente']) }}" class="btn btn-primary">
                <i class="fas fa-check"></i> Confirmer les rendez-vous
            </a>
            <a href="{{ route('doctor.schedule') }}" class="btn btn-outline">
                <i class="fas fa-calendar-alt"></i> Gérer mon agenda
            </a>
            <a href="{{ route('doctor.patients') }}" class="btn btn-outline">
                <i class="fas fa-users"></i> Voir mes patients
            </a>
        </div>
    </div>
@endsection
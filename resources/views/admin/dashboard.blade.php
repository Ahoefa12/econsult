@extends('admin.layout')

@section('title', 'Tableau de bord')

@section('content')
<div class="grid-stats">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-calendar-check"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['appointments_today'] }}</h3>
            <p>Rendez-vous aujourd'hui</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-user-md"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_doctors'] }}</h3>
            <p>Médecins actifs</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_patients'] }}</h3>
            <p>Patients inscrits</p>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['pending_requests'] }}</h3>
            <p>Demandes en attente</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Aperçu rapide</h3>
    </div>
    <div style="padding: 2rem; text-align: center; color: #64748b;">
        <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.2;"></i>
        <p>Les graphiques d'activité seront disponibles une fois connecté à la base de données.</p>
    </div>
</div>
@endsection

@extends('layout.Layout')

@section('title', 'Choisir un Médecin')

@section('content')
    <!-- Import specific CSS for this page -->
    <link rel="stylesheet" href="{{ asset('css/rendez-vous.css') }}">

    <div class="reservation-container">

        <!-- HEADER -->
        <div class="reservation-header">
            <h1>Prendre rendez-vous</h1>
            <p>Réservez votre consultation en quelques étapes simples</p>
        </div>

        <!-- STEPPER -->
        <div class="stepper-container">
            <ul class="steps-list">
                <li class="step active"> <!-- Finished Step -->
                    <div class="step-circle" style="background: #0EAD69; color: white;">1</div>
                    <span class="step-label" style="color: #111827;">Spécialité</span>
                </li>
                <li class="step active"> <!-- Current Step -->
                    <div class="step-circle">2</div>
                    <span class="step-label">Médecin</span>
                </li>
                <li class="step">
                    <div class="step-circle">3</div>
                    <span class="step-label">Date & Heure</span>
                </li>
                <li class="step">
                    <div class="step-circle">4</div>
                    <span class="step-label">Informations</span>
                </li>
            </ul>
        </div>

        <!-- SELECTION CARD -->
        <div class="reservation-card">

            <a href="{{ route('rendez-vous') }}" class="back-link">Retour</a>

            <h2 class="card-title">Choisissez votre médecin</h2>
            @if(request('specialite_id'))
                <span class="selected-specialty-label">Spécialité :
                    <strong>{{ $medecins->first()->speciality->nom ?? 'Non spécifiée' }}</strong></span>
            @endif

            <div class="doctors-grid">
                @forelse($medecins as $medecin)
                    <!-- Link to next step (Date & Heure) with medecin_id -->
                    <a href="{{ route('rendez-vous.date_heure', ['medecin_id' => $medecin->id]) }}" class="doctor-card">
                        <img src="{{ $medecin->photo ?? 'https://img.freepik.com/free-photo/woman-doctor-wearing-lab-coat-with-stethoscope-isolated_1303-29791.jpg' }}"
                            alt="{{ $medecin->prenom }} {{ $medecin->nom }}" class="doctor-avatar">
                        <div class="doctor-info">
                            <span class="doctor-name">Dr. {{ $medecin->prenom }} {{ $medecin->nom }}</span>
                            <span class="doctor-specialty">{{ $medecin->speciality->nom ?? 'Médecine Générale' }}</span>
                        </div>
                    </a>
                @empty
                    <p style="text-align: center; color: #6b7280; grid-column: 1 / -1;">Aucun médecin disponible pour cette
                        spécialité.</p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Reuse the same footer -->


@endsection
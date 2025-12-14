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
        <span class="selected-specialty-label">Spécialité : <strong>Médecine Générale</strong></span>

        @php
            // Mock doctors data
            $doctors = [
                [
                    'name' => 'Dr. Sophie Martin',
                    'specialty' => 'Médecine Générale',
                    'avatar' => 'https://img.freepik.com/free-photo/woman-doctor-wearing-lab-coat-with-stethoscope-isolated_1303-29791.jpg'
                ],
                [
                    'name' => 'Dr. Jean Dupont',
                    'specialty' => 'Médecine Générale',
                    'avatar' => 'https://img.freepik.com/free-photo/smiling-doctor-with-strethoscope-isolated-grey_651396-974.jpg'
                ],
                [
                    'name' => 'Dr. Marie Curie',
                    'specialty' => 'Médecine Générale',
                    'avatar' => 'https://img.freepik.com/free-photo/pleased-young-female-doctor-wearing-medical-robe-stethoscope-around-neck-standing-with-closed-posture_409827-254.jpg'
                ],
                [
                    'name' => 'Dr. Albert Schweitzer',
                    'specialty' => 'Médecine Générale',
                    'avatar' => 'https://img.freepik.com/free-photo/portrait-hansome-young-male-doctor-man_171337-5068.jpg'
                ]
            ];
        @endphp

        <div class="doctors-grid">
            @foreach($doctors as $doc)
                <!-- Link to next step (Date & Heure) -->
                <a href="{{ route('rendez-vous.date_heure') }}" class="doctor-card">
                    <img src="{{ $doc['avatar'] }}" alt="{{ $doc['name'] }}" class="doctor-avatar">
                    <div class="doctor-info">
                        <span class="doctor-name">{{ $doc['name'] }}</span>
                        <span class="doctor-specialty">{{ $doc['specialty'] }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>

<!-- Reuse the same footer -->


@endsection

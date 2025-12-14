@extends('layout.Layout')

@section('title', 'Prendre Rendez-vous')

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
            <li class="step active">
                <div class="step-circle">1</div>
                <span class="step-label">Spécialité</span>
            </li>
            <li class="step">
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
        <h2 class="card-title">Choisissez une spécialité</h2>

        @php
            $specialites = [
                'Médecine Générale', 'Cardiologie', 'Dermatologie', 'Pédiatrie',
                'Gynécologie', 'Ophtalmologie', 'ORL', 'Psychiatrie'
            ];
        @endphp

        <div class="specialty-grid">
            @foreach($specialites as $spec)
                <a href="{{ route('rendez-vous.medecin') }}" class="specialty-btn">
                    {{ $spec }}
                </a>
            @endforeach
        </div>
    </div>

</div>

<!-- Reuse the same footer as other pages -->


@endsection

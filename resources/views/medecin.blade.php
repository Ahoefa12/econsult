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
<footer class="footer">
    <div class="footer-container">
        <div class="footer-row">
            <div class="footer-col">
                <div class="footer-logo">
                    <img src="https://cdn-icons-png.flaticon.com/512/2966/2966327.png" alt="logo">
                    <span>E-Consult</span>
                </div>
                <p class="footer-desc">
                    Votre plateforme de confiance pour la prise de rendez-vous médicaux en ligne. Simple, rapide et sécurisé.
                </p>
                <div class="social-links">
                     <a href="#"><i class="icon fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="icon fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="icon fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="icon fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Liens Rapides</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li><a href="{{ url('/specialites/index') }}">Spécialités</a></li>
                    <li><a href="{{ url('/comment-ca-marche') }}">Comment ça marche</a></li>
                    <li><a href="{{ url('/contactez-nous') }}">Contactez-nous</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> Lomé, Togo</li>
                    <li><i class="fa-solid fa-phone"></i> +228 90 00 00 00</li>
                    <li><i class="fa-solid fa-envelope"></i> contact@e-consult.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 E-Consult. Tous droits réservés.</p>
        </div>
    </div>
</footer>

@endsection

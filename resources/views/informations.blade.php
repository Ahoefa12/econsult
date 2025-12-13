@extends('layout.Layout')

@section('title', 'Informations')

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
            <li class="step active"> <!-- Finished -->
                <div class="step-circle" style="background: #0EAD69; color: white;">1</div>
                <span class="step-label" style="color: #111827;">Spécialité</span>
            </li>
            <li class="step active"> <!-- Finished -->
                <div class="step-circle" style="background: #0EAD69; color: white;">2</div>
                <span class="step-label" style="color: #111827;">Médecin</span>
            </li>
            <li class="step active"> <!-- Finished -->
                <div class="step-circle" style="background: #0EAD69; color: white;">3</div> 
                <span class="step-label" style="color: #111827;">Date & Heure</span>
            </li>
            <li class="step active"> <!-- Current -->
                <div class="step-circle" style="background: #0EAD69; color: white;">4</div>
                <span class="step-label" style="color: #111827;">Informations</span>
            </li>
        </ul>
    </div>

    <!-- FORM CARD -->
    <div class="reservation-card">
        
        <a href="{{ route('rendez-vous.date_heure') }}" class="back-link">Retour</a>

        <h2 class="card-title">Vos informations</h2>

        <form action="#" method="POST"> <!-- Generic action for now -->
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Prénom *</label>
                    <input type="text" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom *</label>
                    <input type="text" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone *</label>
                    <input type="tel" class="form-input" required>
                </div>
                
                <div class="form-group full-width">
                    <label class="form-label">Motif de consultation</label>
                    <textarea class="form-textarea" placeholder="Décrivez brièvement le motif de votre consultation (max 500 caractères)"></textarea>
                </div>
            </div>

            <!-- Submit Button (Green bar as seen in previous images or implied) -->
            <button type="submit" class="action-bar" style="border: none; cursor: pointer; background: #0EAD69;">
                Confirmer le rendez-vous
            </button>
        </form>

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

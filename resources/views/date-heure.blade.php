@extends('layout.Layout')

@section('title', 'Date & Heure')

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
            <li class="step active"> <!-- Current -->
                <div class="step-circle" style="background: #0EAD69; color: white;">3</div> <!-- Image shows step 3 Green circle -->
                <span class="step-label" style="columns: #111827;">Date & Heure</span>
            </li>
            <li class="step">
                <div class="step-circle">4</div>
                <span class="step-label">Informations</span>
            </li>
        </ul>
    </div>

    <!-- SELECTION CARD -->
    <div class="reservation-card">
        
        <a href="{{ route('rendez-vous.medecin') }}" class="back-link">Retour</a>

        <h2 class="card-title">Sélectionnez date et heure</h2>

        <div class="date-time-wrapper">
            <!-- Date Picker -->
            <div class="date-section">
                <label class="section-label">Date de consultation</label>
                <input type="text" placeholder="jj/mm/aaaa" class="date-input" onfocus="(this.type='date')" onblur="(this.type='text')">
            </div>

            <!-- Time Slots -->
            <div class="time-section">
                <label class="section-label">Heure de consultation</label>
                <div class="time-slots-grid">
                    <button class="time-slot-btn">08:00</button>
                    <button class="time-slot-btn">08:30</button>
                    <button class="time-slot-btn">09:00</button>
                    <button class="time-slot-btn">09:30</button>
                    <button class="time-slot-btn">10:00</button>
                    <button class="time-slot-btn">10:30</button>
                    <button class="time-slot-btn">11:00</button>
                    <button class="time-slot-btn">11:30</button>
                    <button class="time-slot-btn">14:00</button>
                    <button class="time-slot-btn">14:30</button>
                    <button class="time-slot-btn">15:00</button>
                    <button class="time-slot-btn">15:30</button>
                    <button class="time-slot-btn">16:00</button>
                    <button class="time-slot-btn">16:30</button>
                    <button class="time-slot-btn">17:00</button>
                    <button class="time-slot-btn">17:30</button>
                </div>
            </div>
        </div>

        <a href="#" class="action-bar">Continuer</a>

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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timeButtons = document.querySelectorAll('.time-slot-btn');
        const continueBtn = document.querySelector('.action-bar');
        const dateInput = document.querySelector('.date-input');
        
        let selectedTime = null;
        let selectedDate = null;

        // Disable continue button initially
        continueBtn.style.opacity = '0.5';
        continueBtn.style.pointerEvents = 'none';

        function checkSelection() {
            if (selectedTime && selectedDate) {
                continueBtn.style.opacity = '1';
                continueBtn.style.pointerEvents = 'auto';
                continueBtn.style.background = '#0EAD69';
                // Set href to the next page
                continueBtn.href = "{{ route('rendez-vous.informations') }}";
            } else {
                continueBtn.style.opacity = '0.5';
                continueBtn.style.pointerEvents = 'none';
                continueBtn.style.background = '#d1d5db';
                continueBtn.removeAttribute('href');
            }
        }

        dateInput.addEventListener('change', function() {
            selectedDate = this.value;
            checkSelection();
        });

        timeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                timeButtons.forEach(b => b.classList.remove('selected'));
                this.classList.add('selected');
                selectedTime = this.innerText;
                console.log("Heure sélectionnée: " + selectedTime);
                checkSelection();
            });
        });
    });
</script>
@endsection

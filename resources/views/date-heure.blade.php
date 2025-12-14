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

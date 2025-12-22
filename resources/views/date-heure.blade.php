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
                    <div class="step-circle" style="background: #0EAD69; color: white;">3</div>
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
                    <input type="date" id="dateInput" class="date-input" min="{{ date('Y-m-d') }}">
                    <div id="dateMessage" style="margin-top: 0.5rem; font-size: 0.85rem; color: #6b7280;"></div>
                </div>

                <!-- Time Slots -->
                <div class="time-section">
                    <label class="section-label">Heure de consultation</label>
                    <div id="loadingMessage" style="text-align: center; padding: 2rem; color: #6b7280;">
                        <i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                        <p>Veuillez sélectionner une date pour voir les créneaux disponibles</p>
                    </div>
                    <div id="timeSlotsContainer" class="time-slots-grid" style="display: none;">
                        <!-- Time slots will be loaded dynamically -->
                    </div>
                </div>
            </div>

            <a href="#" id="continueBtn" class="action-bar" style="opacity: 0.5; pointer-events: none;">Continuer</a>

        </div>

    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInput = document.getElementById('dateInput');
            const timeSlotsContainer = document.getElementById('timeSlotsContainer');
            const loadingMessage = document.getElementById('loadingMessage');
            const dateMessage = document.getElementById('dateMessage');
            const continueBtn = document.getElementById('continueBtn');

            const medecinId = "{{ request('medecin_id') }}";
            let selectedTime = null;
            let selectedDate = null;

            if (!medecinId) {
                alert('Aucun médecin sélectionné. Veuillez retourner à l\'étape précédente.');
                window.location.href = "{{ route('rendez-vous.medecin') }}";
                return;
            }

            // Load available slots when date is selected
            dateInput.addEventListener('change', function () {
                selectedDate = this.value;
                selectedTime = null;

                if (!selectedDate) {
                    timeSlotsContainer.style.display = 'none';
                    loadingMessage.style.display = 'block';
                    loadingMessage.innerHTML = '<i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 0.5rem;"></i><p>Veuillez sélectionner une date pour voir les créneaux disponibles</p>';
                    updateContinueButton();
                    return;
                }

                // Show loading state
                loadingMessage.style.display = 'block';
                loadingMessage.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size: 2rem; margin-bottom: 0.5rem;"></i><p>Chargement des créneaux disponibles...</p>';
                timeSlotsContainer.style.display = 'none';
                timeSlotsContainer.innerHTML = '';

                // Fetch available slots
                fetch(`/api/schedule/available-slots?medecin_id=${medecinId}&date=${selectedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        loadingMessage.style.display = 'none';

                        if (data.success && data.creneaux && data.creneaux.length > 0) {
                            timeSlotsContainer.style.display = 'grid';

                            // Format date for display
                            const dateObj = new Date(selectedDate);
                            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                            const formattedDate = dateObj.toLocaleDateString('fr-FR', options);
                            dateMessage.innerHTML = `<i class="fas fa-check-circle" style="color: #0EAD69;"></i> ${data.creneaux.length} créneaux disponibles le ${formattedDate}`;

                            // Create time slot buttons
                            data.creneaux.forEach(creneau => {
                                const button = document.createElement('button');
                                button.className = 'time-slot-btn';
                                button.textContent = creneau.heure;
                                button.dataset.datetime = creneau.datetime;

                                button.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    // Remove selection from all buttons
                                    document.querySelectorAll('.time-slot-btn').forEach(btn => {
                                        btn.classList.remove('selected');
                                    });
                                    // Select this button
                                    this.classList.add('selected');
                                    selectedTime = this.textContent;
                                    updateContinueButton();
                                });

                                timeSlotsContainer.appendChild(button);
                            });
                        } else {
                            timeSlotsContainer.style.display = 'none';
                            loadingMessage.style.display = 'block';
                            loadingMessage.innerHTML = '<i class="fas fa-calendar-times" style="font-size: 2rem; margin-bottom: 0.5rem; color: #ef4444;"></i><p>Aucun créneau disponible pour cette date. Veuillez choisir une autre date.</p>';
                            dateMessage.innerHTML = '<i class="fas fa-exclamation-circle" style="color: #ef4444;"></i> Aucun créneau disponible';
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des créneaux:', error);
                        loadingMessage.style.display = 'block';
                        loadingMessage.innerHTML = '<i class="fas fa-exclamation-triangle" style="font-size: 2rem; margin-bottom: 0.5rem; color: #f59e0b;"></i><p>Erreur lors du chargement des créneaux. Veuillez réessayer.</p>';
                        timeSlotsContainer.style.display = 'none';
                        dateMessage.innerHTML = '<i class="fas fa-exclamation-circle" style="color: #f59e0b;"></i> Erreur de chargement';
                    });
            });

            function updateContinueButton() {
                if (selectedTime && selectedDate) {
                    continueBtn.style.opacity = '1';
                    continueBtn.style.pointerEvents = 'auto';
                    continueBtn.style.background = '#0EAD69';

                    // Build URL with query parameters
                    const baseUrl = "{{ route('rendez-vous.informations') }}";
                    const params = new URLSearchParams({
                        medecin_id: medecinId,
                        date: selectedDate,
                        heure: selectedTime
                    });
                    continueBtn.href = baseUrl + '?' + params.toString();
                } else {
                    continueBtn.style.opacity = '0.5';
                    continueBtn.style.pointerEvents = 'none';
                    continueBtn.style.background = '#d1d5db';
                    continueBtn.removeAttribute('href');
                }
            }
        });
    </script>
@endsection
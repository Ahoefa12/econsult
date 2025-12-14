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
        
        <a href="{{ route('rendez-vous.date_heure', request()->all()) }}" class="back-link">Retour</a>

        <h2 class="card-title">Vos informations</h2>

        <form action="{{ route('rendez-vous.confirmer') }}" method="POST">
            @csrf
            <!-- Hidden Fields to Pass Previous Step Data -->
            <input type="hidden" name="medecin_id" value="{{ request('medecin_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <input type="hidden" name="heure" value="{{ request('heure') }}">

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Prénom *</label>
                    <input type="text" name="prenom" class="form-input" value="{{ Auth::check() && Auth::user()->patient ? Auth::user()->patient->prenom : '' }}" required readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="nom" class="form-input" value="{{ Auth::check() && Auth::user()->patient ? Auth::user()->patient->nom : '' }}" required readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-input" value="{{ Auth::check() && Auth::user()->patient ? Auth::user()->patient->email : '' }}" required readonly>
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone *</label>
                    <input type="tel" name="telephone" class="form-input" value="{{ Auth::check() && Auth::user()->patient ? Auth::user()->patient->telephone : '' }}" required>
                </div>
                
                <div class="form-group full-width">
                    <label class="form-label">Motif de consultation</label>
                    <textarea name="motif" class="form-textarea" placeholder="Décrivez brièvement le motif de votre consultation (max 500 caractères)"></textarea>
                </div>
            </div>

            <!-- Submit Button (Green bar as seen in previous images or implied) -->
            <button type="submit" class="action-bar" style="border: none; cursor: pointer; background: #0EAD69;">
                Confirmer le rendez-vous
            </button>
        </form>

    </div>

</div>

@endsection

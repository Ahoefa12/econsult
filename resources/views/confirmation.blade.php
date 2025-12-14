@extends('layout.Layout')

@section('title', 'Confirmation de Rendez-vous')


<!-- Import specific CSS for this page (reusing rendez-vous CSS for container styles) -->
<link rel="stylesheet" href="{{ asset('css/rendez-vous.css') }}">
<style>
    .confirmation-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 1rem;
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background-color: #d1fae5; /* Green 100 */
        color: #059669; /* Green 600 */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin-bottom: 2rem;
    }

    .confirmation-title {
        font-size: 2rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1rem;
    }

    .confirmation-message {
        color: #4b5563;
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .confirmation-message strong {
        color: #111827;
        font-weight: 600;
    }

    .details-card {
        background: #f9fafb;
        border-radius: 12px;
        padding: 2rem;
        width: 100%;
        text-align: left;
        margin-bottom: 2.5rem;
    }

    .details-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 1.5rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        color: #374151;
        font-size: 1rem;
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-icon {
        width: 24px;
        margin-right: 12px;
        color: #0EAD69;
        text-align: center;
    }

    .detail-label {
        font-weight: 600;
        margin-right: 6px;
    }

    .btn-return {
        background-color: #0EAD69;
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.2s;
        display: inline-block;
    }

    .btn-return:hover {
        background-color: #0b8a54;
    }
</style>

<div class="confirmation-container">
    <div class="success-icon">
        <i class="fa-solid fa-check"></i>
    </div>

    <h1 class="confirmation-title">Rendez-vous confirmé !</h1>

    <p class="confirmation-message">
        Votre consultation a été réservée avec succès. Un email de confirmation a été envoyé à <strong>{{ $appointment['email'] ?? 'diane@gmail.com' }}</strong>
    </p>

    <div class="details-card">
        <h3 class="details-title">Détails de votre rendez-vous :</h3>

        <div class="detail-item">
            <div class="detail-icon"><i class="fa-solid fa-hospital-user"></i></div>
            <span class="detail-label">Spécialité :</span>
            <span>{{ $appointment['specialite'] ?? 'Dermatologie' }}</span>
        </div>

        <div class="detail-item">
            <div class="detail-icon"><i class="fa-regular fa-user"></i></div>
            <span class="detail-label">Médecin :</span>
            <span>{{ $appointment['medecin'] ?? 'Dr. Marie Lefebvre' }}</span>
        </div>

        <div class="detail-item">
            <div class="detail-icon"><i class="fa-regular fa-calendar"></i></div>
            <span class="detail-label">Date :</span>
            <span>{{ $appointment['date'] ?? 'samedi 20 décembre 2025' }}</span>
        </div>

        <div class="detail-item">
            <div class="detail-icon"><i class="fa-regular fa-clock"></i></div>
            <span class="detail-label">Heure :</span>
            <span>{{ $appointment['heure'] ?? '10:00' }}</span>
        </div>
    </div>

    <a href="{{ route('Accueil') }}" class="btn-return">Retour à l'accueil</a>
</div>

@endsection

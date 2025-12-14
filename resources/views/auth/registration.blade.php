@extends('layout.Layout')

@section('title', 'Inscription')

@section('content')
<style>
    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background-color: #f3f4f6;
    }

    .auth-card {
        background: white;
        padding: 2.5rem;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        width: 100%;
        max-width: 600px; /* Wider for more fields */
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 0.5rem;
    }

    .auth-header p {
        color: #6b7280;
        font-size: 0.95rem;
    }

    .auth-form .form-row {
        display: flex;
        gap: 1rem;
    }

    .auth-form .form-group {
        margin-bottom: 1.5rem;
        flex: 1;
    }

    .auth-form label {

        display: block;
        font-size: 0.9rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .auth-form input {

        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .auth-form input:focus {
        outline: none;
        border-color: #0EAD69;
        box-shadow: 0 0 0 3px rgba(14, 173, 105, 0.1);
    }

    .auth-btn {
        width: 100%;
        background-color: #0EAD69;
        color: white;
        padding: 0.8rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-top: 1rem;
    }

    .auth-btn:hover {

        background-color: #0b8a54;
    }

    .auth-footer {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .auth-footer a {
        color: #0EAD69;
        text-decoration: none;
        font-weight: 500;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    .alert-danger {
        background-color: #fef2f2;
        border: 1px solid #fee2e2;
        color: #991b1b;
        padding: 0.75rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 1.25rem;
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Créer un compte patient</h1>
            <p>Rejoignez E-Consult pour gérer vos rendez-vous simplement</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registration.post') }}" method="post" class="auth-form">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" placeholder="Jean" required autofocus>
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Dupont" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Adresse E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="exemple@email.com" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}" placeholder="+228 90 00 00 00" required>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse de résidence</label>
                    <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}" placeholder="Lomé, Quartier..." required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="8 caractères minimum" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Répétez le mot de passe" required>
            </div>

            <button type="submit" class="auth-btn">
                S'inscrire
            </button>
        </form>

        <div class="auth-footer">
            <p>Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a></p>
        </div>
    </div>
</div>
@endsection

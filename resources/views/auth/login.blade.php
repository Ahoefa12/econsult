@extends('layout.Layout')

@section('title', 'Connexion')

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
        max-width: 450px;
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

    .auth-form .form-group {
        margin-bottom: 1.5rem;
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
            <h1>Bon retour parmi nous</h1>
            <p>Connectez-vous pour accéder à votre espace patient</p>
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

        <form action="{{ route('login.post') }}" method="post" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Adresse E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="exemple@email.com" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
            </div>

            <button type="submit" class="auth-btn">
                Se connecter
            </button>
        </form>

        <div class="auth-footer">
            <p>Pas encore de compte ? <a href="{{ route('registration') }}">Créer un compte</a></p>
        </div>
    </div>
</div>
@endsection

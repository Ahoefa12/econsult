<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MediConsult' }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('css/specialite.index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment-ca-marche.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">

</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="logo">
            <div class="brand-logo">
                <i class="fas fa-heart-pulse"></i>
            </div>
            <span>E-Consult</span>
        </div>

        <nav>
            <a href="{{ url('/') }}">Accueil</a>
            <a href="{{ url('/specialites/index') }}">Spécialités</a>
            <a href="{{ url('/comment-ca-marche') }}">Comment ça marche</a>
            <a href="{{ url('/contactez-nous') }}">Contactez-nous</a>
        </nav>

        <div style="display: flex; align-items: center; gap: 1rem;">
            @auth
                <div
                    style="display: flex; align-items: center; gap: 0.75rem; background: #f3f4f6; padding: 0.5rem 1rem; border-radius: 50px;">
                    <i class="fas fa-user-circle" style="color: #0EAD69; font-size: 1.25rem;"></i>
                    <span style="font-weight: 600; font-size: 0.9rem; color: #374151;">{{ Auth::user()->prenom }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0; display: flex;">
                        @csrf
                        <button type="submit"
                            style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0.25rem; display: flex; align-items: center;"
                            title="Déconnexion">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}"
                    style="text-decoration: none; color: #374151; font-weight: 500; font-size: 0.9rem;">Connexion</a>
            @endauth
            <a class="btn-primary" href="{{ url('/rendez-vous') }}">Rendez-vous</a>
        </div>
    </header>


    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-col">
                    <div class="footer-logo">
                        <div class="brand-logo" style="width: 35px; height: 35px; font-size: 1rem;">
                            <i class="fas fa-heart-pulse"></i>
                        </div>
                        <span>E-Consult</span>
                    </div>
                    <p class="footer-desc">
                        Votre plateforme de confiance pour la prise de rendez-vous médicaux en ligne. Simple, rapide et
                        sécurisé.
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
                        <!-- <li><a href="{{ route('admin.dashboard') }}" style="color: #2563eb; font-weight: 500;">Administration</a></li> -->
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

    @yield('scripts')
</body>

</html>
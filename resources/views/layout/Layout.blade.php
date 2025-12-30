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
            <span style="white-space: nowrap;">E-Consult</span>
        </div>

        <nav class="nav-links">
            <a href="{{ url('/') }}">Accueil</a>
            <a href="{{ url('/specialites/index') }}">Spécialités</a>
            <a href="{{ url('/comment-ca-marche') }}">Comment ça marche</a>
            <a href="{{ url('/contactez-nous') }}">Contactez-nous</a>
        </nav>

        <button class="mobile-menu-toggle" id="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>

        <div style="display: flex; align-items: center; gap: 1rem;">
            @auth
                <div class="user-dropdown">
                    <button class="user-dropdown-btn">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ Auth::user()->prenom }}</span>
                        <i class="fas fa-chevron-down" style="font-size: 0.7rem;"></i>
                    </button>
                    <div class="user-dropdown-content">
                        <!-- Add profile links here if needed -->
                        <div class="dropdown-header">
                            <strong>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</strong>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                        <hr>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-link">
                                <i class="fas fa-sign-out-alt"></i>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="login-link">Connexion</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const navLinks = document.querySelector('.nav-links');

            if (menuBtn && navLinks) {
                menuBtn.addEventListener('click', function () {
                    navLinks.classList.toggle('active');
                    const icon = menuBtn.querySelector('i');
                    if (navLinks.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }

            // Close menu when clicking outside
            document.addEventListener('click', function (event) {
                if (!navLinks.contains(event.target) && !menuBtn.contains(event.target)) {
                    navLinks.classList.remove('active');
                    const icon = menuBtn.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        });
    </script>
</body>

</html>
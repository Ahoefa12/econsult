@extends('layout.Layout')

@section('title', 'Comment ça marche ?')

@section('content')
    <!-- HERO SECTION -->
    <div class="ccm-hero">
        <div class="ccm-hero-content">
            <h1>Comment ça marche ?</h1>
            <p>
                Réservez votre consultation médicale en 4 étapes simples et rapides. 
                Nous avons simplifié le processus pour vous permettre de voir un médecin sans tracas.
            </p>
        </div>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="ccm-container">
        
        <!-- STEPS SECTION -->
        <div class="steps-wrapper">
            <!-- Connecting Line (Visible on Desktop) -->
            <div class="steps-line"></div>

            <div class="steps-grid">
                <!-- Step 1 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <div class="step-number">1</div>
                        <i class="step-icon fa-solid fa-hospital-user"></i>
                    </div>
                    <h3>Choisissez votre spécialité</h3>
                    <p>
                        Parcourez notre liste de spécialités médicales et sélectionnez celle qui correspond à vos besoins de santé.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <div class="step-number">2</div>
                        <i class="step-icon fa-regular fa-calendar-check"></i>
                    </div>
                    <h3>Sélectionnez un créneau</h3>
                    <p>
                        Consultez les disponibilités de nos médecins en temps réel et choisissez la date et l'heure qui vous arrangent.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <div class="step-number">3</div>
                        <i class="step-icon fa-solid fa-clipboard-check"></i>
                    </div>
                    <h3>Confirmez le rendez-vous</h3>
                    <p>
                        Remplissez vos informations personnelles et validez votre demande de rendez-vous en quelques clics.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="step-card">
                    <div class="step-icon-wrapper">
                        <div class="step-number">4</div>
                        <i class="step-icon fa-solid fa-envelope-open-text"></i>
                    </div>
                    <h3>Recevez votre confirmation</h3>
                    <p>
                        Vous recevrez instantanément un email de confirmation avec tous les détails de votre consultation.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA SECTION -->
        <div class="cta-section">
            <div class="cta-content">
                <h2>Prêt à prendre rendez-vous ?</h2>
                <p>
                    N'attendez plus pour prendre soin de votre santé. Trouvez le bon médecin dès maintenant.
                </p>
                <a href="{{ url('/specialites/index') }}" class="btn-cta">
                    Commencer maintenant <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>

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

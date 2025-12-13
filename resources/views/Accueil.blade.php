@extends('layout.Layout')

@section('title', 'Accueil')

@section('content')

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-content">
            <h1>
                Réservez votre consultation<br>
                <span>médicale en ligne</span>
            </h1>

            <p class="subtitle">
                Accédez aux meilleurs soins de santé sans vous déplacer. 
                Prenez rendez-vous avec des médecins certifiés en quelques clics.
            </p>

            <div class="hero-buttons">
                <a href="{{ url('/rendez-vous') }}" class="btn-green">Prendre rendez-vous</a>
                <a href="{{ url('/specialites/index') }}" class="btn-outline">Nos spécialités</a>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION (Floating Cards) -->
    <div class="features-wrapper">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3>Réservation Rapide</h3>
                <p>Sélectionnez votre médecin et choisissez le créneau qui vous convient en moins de 2 minutes.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
                <h3>Médecins Certifiés</h3>
                <p>Tous nos praticiens sont vérifiés et qualifiés pour vous garantir des soins de qualité.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <h3>Rappels SMS</h3>
                <p>Recevez des notifications automatiques pour ne jamais manquer vos rendez-vous.</p>
            </div>
        </div>
    </div>

    <!-- BENEFITS SECTION -->
    <section class="card-section">
        <div class="section-header">
            <h2>Pourquoi nous choisir ?</h2>
            <p>Nous simplifions l'accès aux soins pour vous et votre famille grâce à une plateforme intuitive et sécurisée.</p>
        </div>

        <div class="benefits-grid">
            <div class="benefit-item">
                <i class="fa-solid fa-shield-halved"></i>
                <h3>Données Sécurisées</h3>
                <p>Vos informations médicales sont cryptées et protégées conformément aux normes internationales.</p>
            </div>

            <div class="benefit-item">
                <i class="fa-solid fa-hospital"></i>
                <h3>Large Réseau</h3>
                <p>Accédez à un vaste réseau de cliniques et de spécialistes à travers tout le pays.</p>
            </div>

            <div class="benefit-item">
                <i class="fa-solid fa-clock"></i>
                <h3>Disponibilité 24/7</h3>
                <p>Notre service de prise de rendez-vous est accessible à tout moment, jour et nuit.</p>
            </div>

            <div class="benefit-item">
                <i class="fa-solid fa-headset"></i>
                <h3>Support Dédié</h3>
                <p>Une équipe d'assistance est à votre écoute pour vous guider en cas de besoin.</p>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section class="card-section" style="background: #f8fafc;">
        <div class="section-header">
            <h2>Ce que disent nos patients</h2>
            <p>La satisfaction de nos utilisateurs est notre priorité absolue.</p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <p class="testimonial-text">
                    "Application incroyablement simple ! J'ai pu trouver un cardiologue pour ma mère en quelques minutes. Je recommande vivement."
                </p>
                <div class="testimonial-author">
                    <span>Alice Dubois</span>
                </div>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">
                    "Fini les longues files d'attente au cabinet. Je prends mes rendez-vous depuis mon canapé. Un vrai gain de temps."
                </p>
                <div class="testimonial-author">
                    <span>Marc K.</span>
                </div>
            </div>

            <div class="testimonial-card">
                <p class="testimonial-text">
                    "Le système de rappel est top. Plus aucun risque d'oublier mes consultations. Merci à toute l'équipe E-Consult."
                </p>
                <div class="testimonial-author">
                    <span>Sarah T.</span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- PARTNERS LOGOS (Placeholder Text for now as images were broken/local) -->
    <!-- Ideally, you'd use real logos here -->
    <!-- 
    <section class="partners-section">
        <h2 style="text-align:center; font-size: 1.5rem; color: #4b5563; margin-bottom: 30px;">Ils nous font confiance</h2>
        <div class="partners-grid">
            <h3 style="color:#94a3b8;">CLINIQUE ALAFIA</h3>
            <h3 style="color:#94a3b8;">AUTEL D'ELI</h3>
            <h3 style="color:#94a3b8;">LE COEUR</h3>
            <h3 style="color:#94a3b8;">CHU HEDZRANAWOE</h3>
        </div>
    </section>
    -->

    <!-- FOOTER -->
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

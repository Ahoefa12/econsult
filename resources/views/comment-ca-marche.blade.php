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

@endsection

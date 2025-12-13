@extends('layout.Layout')

@section('title', 'Spécialités')

@section('content')

    <!-- HERO SECTION -->
    <div class="specialite-hero">
        <div class="hero-content">
            <h1>Nos Spécialités Médicales</h1>
            <p>
                Accédez à une large gamme de soins avec des praticiens qualifiés. 
                Sélectionnez une spécialité pour trouver le médecin qu'il vous faut.
            </p>
        </div>
    </div>

    <div class="specialites-container">
        <div class="specialites-grid">
            @php
                $specialites = [
                    [
                        'icon' => 'fa-solid fa-heart-pulse',
                        'color_class' => 'blue',
                        'title' => 'Médecine Générale',
                        'desc'  => 'Suivi médical complet, bilans de santé réguliers et soins préventifs pour toute la famille.',
                        'count' => 12
                    ],
                    [
                        'icon' => 'fa-regular fa-heart',
                        'color_class' => 'green', 
                        'title' => 'Cardiologie',
                        'desc'  => 'Diagnostic et traitement des maladies du cœur et des vaisseaux sanguins par des experts.',
                        'count' => 8
                    ],
                    [
                        'icon' => 'fa-solid fa-pump-medical',
                        'color_class' => 'pink',
                        'title' => 'Dermatologie',
                        'desc'  => 'Soins spécialisés pour la peau, les cheveux, les ongles et les muqueuses.',
                        'count' => 6
                    ],
                    [
                        'icon' => 'fa-solid fa-baby',
                        'color_class' => 'yellow',
                        'title' => 'Pédiatrie',
                        'desc'  => 'Suivi de la santé, du développement et de la croissance de vos enfants dès la naissance.',
                        'count' => 10
                    ],
                    [
                        'icon' => 'fa-solid fa-venus',
                        'color_class' => 'purple',
                        'title' => 'Gynécologie',
                        'desc'  => 'Suivi de la santé féminine, grossesse, fertilité et dépistages réguliers.',
                        'count' => 12
                    ],
                    [
                        'icon' => 'fa-solid fa-eye',
                        'color_class' => 'cyan',
                        'title' => 'Ophtalmologie',
                        'desc'  => 'Examens de la vision, correction optique et traitement des pathologies oculaires.',
                        'count' => 5
                    ],
                    [
                        'icon' => 'fa-solid fa-ear-listen',
                        'color_class' => 'orange',
                        'title' => 'ORL',
                        'desc'  => 'Prise en charge des troubles de l\'oreille, du nez, de la gorge et du cou.',
                        'count' => 6
                    ],
                    [
                        'icon' => 'fa-solid fa-brain',
                        'color_class' => 'indigo',
                        'title' => 'Psychiatrie',
                        'desc'  => 'Accompagnement et traitement des troubles de la santé mentale et émotionnelle.',
                        'count' => 9
                    ],
                ];
            @endphp
        
            @foreach($specialites as $spec)
                <div class="specialite-card">
                    
                    <div class="icon-box {{ $spec['color_class'] }}">
                        <i class="{{ $spec['icon'] }}"></i>
                    </div>
        
                    <div class="card-content">
                        <h3 class="titre">{{ $spec['title'] }}</h3>
        
                        <p class="description">
                            {{ $spec['desc'] }}
                        </p>
        
                        <div class="medecins-count">
                            <i class="fa-regular fa-user"></i> 
                            {{ $spec['count'] }} médecins
                        </div>
                    </div>
                </div>
            @endforeach
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

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
    
@endsection

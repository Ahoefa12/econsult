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
                // Mapping des icônes et couleurs pour les spécialités communes
                $specialiteStyles = [
                    'Médecine Générale' => ['icon' => 'fa-solid fa-heart-pulse', 'color' => 'blue'],
                    'Cardiologie' => ['icon' => 'fa-regular fa-heart', 'color' => 'green'],
                    'Dermatologie' => ['icon' => 'fa-solid fa-pump-medical', 'color' => 'pink'],
                    'Pédiatrie' => ['icon' => 'fa-solid fa-baby', 'color' => 'yellow'],
                    'Gynécologie' => ['icon' => 'fa-solid fa-venus', 'color' => 'purple'],
                    'Ophtalmologie' => ['icon' => 'fa-solid fa-eye', 'color' => 'cyan'],
                    'ORL' => ['icon' => 'fa-solid fa-ear-listen', 'color' => 'orange'],
                    'Psychiatrie' => ['icon' => 'fa-solid fa-brain', 'color' => 'indigo'],
                ];

                // Couleurs par défaut pour les nouvelles spécialités
                $defaultColors = ['blue', 'green', 'pink', 'yellow', 'purple', 'cyan', 'orange', 'indigo'];
                $colorIndex = 0;
            @endphp

            @foreach($specialites as $specialite)
                @php
                    // Utiliser le style prédéfini ou un style par défaut
                    if (isset($specialiteStyles[$specialite->nom])) {
                        $icon = $specialiteStyles[$specialite->nom]['icon'];
                        $color = $specialiteStyles[$specialite->nom]['color'];
                    } else {
                        $icon = 'fa-solid fa-stethoscope'; // Icône par défaut
                        $color = $defaultColors[$colorIndex % count($defaultColors)];
                        $colorIndex++;
                    }
                @endphp

                <a href="{{ route('rendez-vous.medecin', ['specialite_id' => $specialite->id]) }}"
                    class="specialite-card">

                    <div class="icon-box {{ $color }}">
                        <i class="{{ $icon }}"></i>
                    </div>

                    <div class="card-content">
                        <h3 class="titre">{{ $specialite->nom }}</h3>

                        <p class="description">
                            Consultez nos médecins spécialisés en {{ $specialite->nom }} pour des soins de qualité.
                        </p>

                        <div class="medecins-count">
                            <i class="fa-regular fa-user"></i>
                            {{ $specialite->medecins_count }} médecin{{ $specialite->medecins_count > 1 ? 's' : '' }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endsection
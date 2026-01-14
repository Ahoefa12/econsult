@extends('admin.layout')

@section('title', 'Gestion des Spécialités')

@section('content')
    <style>
        .add-card {
            background: white;
            border: 2px dashed #e5e7eb;
            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            min-height: 180px;
        }

        .add-card:hover {
            border-color: var(--primary);
            background: #eff6ff;
        }

        .add-card i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .add-card span {
            font-weight: 600;
            color: var(--primary);
        }

        .specialty-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            position: relative;
            transition: all 0.2s;
        }

        .specialty-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .icon-box-custom {
            width: 48px;
            height: 48px;
            background: #e0e7ff;
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .dropdown-toggle:hover {
            background: #f3f4f6;
            color: var(--primary);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 150px;
            z-index: 10;
            margin-top: 0.25rem;
            padding: 0.5rem 0;
        }

        /* Le menu est géré par JavaScript pour plus de fiabilité */


        .dropdown-menu a,
        .dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            width: 100%;
            border: none;
            background: none;
            color: #374151;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f3f4f6;
        }

        .dropdown-menu button.delete-btn {
            color: #dc2626;
        }

        .dropdown-menu button.delete-btn:hover {
            background: #fef2f2;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border-left: 4px solid #16a34a;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }
    </style>

    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem;">
        <!-- Bouton Ajouter -->
        <a href="{{ route('admin.specialties.create') }}" class="add-card">
            <i class="fas fa-plus-circle"></i>
            <span>Ajouter une spécialité</span>
        </a>

        @foreach($specialties as $spec)
            <div class="specialty-card">
                <div class="card-header-custom">
                    <div class="icon-box-custom">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <!-- Menu dropdown -->
                    <div class="dropdown">
                        <button class="dropdown-toggle">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('admin.specialties.edit', $spec->id) }}">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('admin.specialties.delete', $spec->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"
                                    onclick="return confirm('Voulez-vous vraiment supprimer cette spécialité ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem;">{{ $spec->nom }}</h3>
                    <p style="color: var(--secondary); font-size: 0.9rem;">
                        <i class="fas fa-user-md"></i> {{ $spec->medecins_count }}
                        médecin{{ $spec->medecins_count > 1 ? 's' : '' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        // Gestion du dropdown avec JavaScript pour une meilleure fiabilité
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.dropdown');
            
            dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                // Toggle au clic
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    // Fermer tous les autres dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(m => {
                        if (m !== menu) {
                            m.style.display = 'none';
                        }
                    });
                    
                    // Toggle le menu actuel
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                });
            });
            
            // Fermer le dropdown si on clique ailleurs
            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            });
            
            // Empêcher la fermeture si on clique dans le menu
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
@endsection
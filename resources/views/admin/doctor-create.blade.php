@extends('admin.layout')

@section('title', 'Ajouter un Médecin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nouveau Médecin</h3>
            <a href="{{ route('admin.doctors') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <!-- Informations personnelles -->
                    <div class="form-section">
                        <h4 class="section-title">Informations personnelles</h4>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom">Nom <span class="required">*</span></label>
                                <input type="text" id="nom" name="nom" class="form-control" required
                                    value="{{ old('nom') }}">
                                @error('nom')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="prenom">Prénom <span class="required">*</span></label>
                                <input type="text" id="prenom" name="prenom" class="form-control" required
                                    value="{{ old('prenom') }}">
                                @error('prenom')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" required
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="telephone">Téléphone <span class="required">*</span></label>
                                <input type="tel" id="telephone" name="telephone" class="form-control" required
                                    value="{{ old('telephone') }}">
                                @error('telephone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe <span class="required">*</span></label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <small class="form-hint">Minimum 8 caractères</small>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Informations professionnelles -->
                    <div class="form-section">
                        <h4 class="section-title">Informations professionnelles</h4>

                        <div class="form-group">
                            <label for="specialite_id">Spécialité <span class="required">*</span></label>
                            <select id="specialite_id" name="specialite_id" class="form-control" required>
                                <option value="">Sélectionnez une spécialité</option>
                                @foreach(\App\Models\Specialite::all() as $specialite)
                                    <option value="{{ $specialite->id }}" {{ old('specialite_id') == $specialite->id ? 'selected' : '' }}>
                                        {{ $specialite->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('specialite_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="adresse_cabinet">Adresse du cabinet <span class="required">*</span></label>
                            <textarea id="adresse_cabinet" name="adresse_cabinet" class="form-control" rows="3"
                                required>{{ old('adresse_cabinet') }}</textarea>
                            @error('adresse_cabinet')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diplomes">Diplômes</label>
                            <textarea id="diplomes" name="diplomes" class="form-control" rows="3"
                                placeholder="Séparez les diplômes par des virgules">{{ old('diplomes') }}</textarea>
                            <small class="form-hint">Exemple: Doctorat en Médecine, Spécialisation en Cardiologie</small>
                            @error('diplomes')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="horaires_travail">Horaires de travail</label>
                            <textarea id="horaires_travail" name="horaires_travail" class="form-control" rows="3"
                                placeholder="Exemple: Lundi-Vendredi: 9h-17h">{{ old('horaires_travail') }}</textarea>
                            @error('horaires_travail')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="photo">Photo de profil</label>
                            <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
                            <small class="form-hint">Format accepté: JPG, PNG (Max: 2MB)</small>
                            @error('photo')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.doctors') }}" class="btn btn-outline">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .card-body {
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            gap: 2rem;
        }

        .form-section {
            background: var(--gray-100);
            padding: 1.5rem;
            border-radius: 0.75rem;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.5rem;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-hint {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.8rem;
            color: var(--secondary);
        }

        .error-message {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.8rem;
            color: var(--danger);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--gray-200);
        }

        textarea.form-control {
            resize: vertical;
            font-family: inherit;
        }

        select.form-control {
            cursor: pointer;
        }

        input[type="file"].form-control {
            padding: 0.5rem;
        }
    </style>
@endsection
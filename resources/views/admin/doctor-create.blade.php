@extends('admin.layout')

@section('title', 'Ajouter un Médecin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user-plus" style="margin-right: 0.5rem; color: var(--primary);"></i>
                Nouveau Médecin
            </h3>
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
                        <h4 class="section-title">
                            <i class="fas fa-id-card"></i>
                            Informations personnelles
                        </h4>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom">Nom <span class="required">*</span></label>
                                <input type="text" id="nom" name="nom" class="form-control" required
                                    value="{{ old('nom') }}" placeholder="Ex: Dupont">
                                @error('nom')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="prenom">Prénom <span class="required">*</span></label>
                                <input type="text" id="prenom" name="prenom" class="form-control" required
                                    value="{{ old('prenom') }}" placeholder="Ex: Jean">
                                @error('prenom')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" required
                                    value="{{ old('email') }}" placeholder="jean.dupont@email.com">
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="telephone">Téléphone <span class="required">*</span></label>
                                <input type="tel" id="telephone" name="telephone" class="form-control" required
                                    value="{{ old('telephone') }}" placeholder="01 23 45 67 89">
                                @error('telephone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
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
                        <h4 class="section-title">
                            <i class="fas fa-user-md"></i>
                            Informations professionnelles
                        </h4>

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
                            <textarea id="adresse_cabinet" name="adresse_cabinet" class="form-control" rows="3" required
                                placeholder="Adresse complète du cabinet...">{{ old('adresse_cabinet') }}</textarea>
                            @error('adresse_cabinet')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diplomes">Diplômes</label>
                            <textarea id="diplomes" name="diplomes" class="form-control" rows="3"
                                placeholder="Séparez les diplômes par des virgules">{{ old('diplomes') }}</textarea>
                            <small class="form-hint">Ex: Doctorat en Médecine, Spécialisation en Cardiologie</small>
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

                        <div class="form-group" style="margin-bottom: 0;">
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
                    <a href="{{ route('admin.doctors') }}" class="btn btn-outline"
                        style="min-width: 120px; justify-content: center;">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary" style="min-width: 200px; justify-content: center;">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('admin.layout')

@section('title', 'Modifier un Médecin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modifier un Médecin</h3>
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('admin.doctors.schedule', $doctor->id) }}" class="btn btn-primary">
                    <i class="fas fa-calendar-alt"></i> Gérer l'agenda
                </a>
                <a href="{{ route('admin.doctors') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Informations personnelles -->
                    <div class="form-section">
                        <h4 class="section-title">Informations personnelles</h4>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="nom">Nom <span class="required">*</span></label>
                                <input type="text" id="nom" name="nom" class="form-control" required
                                    value="{{ $doctor->nom }}">
                                @error('nom')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="prenom">Prénom <span class="required">*</span></label>
                                <input type="text" id="prenom" name="prenom" class="form-control" required
                                    value="{{ $doctor->prenom }}">
                                @error('prenom')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" required
                                    value="{{ $doctor->email }}">
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="telephone">Téléphone <span class="required">*</span></label>
                                <input type="tel" id="telephone" name="telephone" class="form-control" required
                                    value="{{ $doctor->telephone }}">
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
                                    <option value="{{ $specialite->id }}" {{ $doctor->specialite_id == $specialite->id ? 'selected' : '' }}>
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
                                required>{{ $doctor->adresse_cabinet }}</textarea>
                            @error('adresse_cabinet')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="diplomes">Diplômes</label>
                            <textarea id="diplomes" name="diplomes" class="form-control" rows="3"
                                placeholder="Séparez les diplômes par des virgules">{{ $doctor->diplomes }}</textarea>
                            <small class="form-hint">Exemple: Doctorat en Médecine, Spécialisation en Cardiologie</small>
                            @error('diplomes')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="{{ route('admin.doctors') }}" class="btn btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>

@endsection
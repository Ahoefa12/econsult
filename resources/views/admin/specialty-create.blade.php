@extends('admin.layout')

@section('title', 'Ajouter une Spécialité')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nouvelle Spécialité</h3>
            <a href="{{ route('admin.specialties') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
        <div style="padding: 2rem;">
            <form action="{{ route('admin.specialties.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label for="nom" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">
                        Nom de la spécialité <span style="color: #dc2626;">*</span>
                    </label>
                    <input type="text" id="nom" name="nom"
                        style="width: 100%; padding: 0.75rem; border: 1px solid {{ $errors->has('nom') ? '#dc2626' : '#d1d5db' }}; border-radius: 0.5rem; font-size: 1rem;"
                        value="{{ old('nom') }}" required placeholder="Ex: Cardiologie">
                    @error('nom')
                        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.specialties') }}" class="btn btn-secondary">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
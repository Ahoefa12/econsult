@extends('admin.layout')

@section('title', 'Gestion des Patients')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dossiers patients</h3>
        <div style="display: flex; gap: 1rem;">
            <input type="text" placeholder="Rechercher un patient..." style="padding: 0.5rem 1rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; outline: none;">
            <button class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouveau
            </button>
        </div>
    </div>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Dernière visite</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                <tr>
                    <td>
                        <div style="font-weight: 500;">{{ $patient->nom }} {{ $patient->prenom }}</div>
                    </td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->telephone }}</td>
                    <td>{{ $patient->updated_at->format('d/m/Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <button class="action-btn" title="Dossier Médical"><i class="fas fa-file-medical"></i></button>
                            <button class="action-btn" title="Historique"><i class="fas fa-history"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

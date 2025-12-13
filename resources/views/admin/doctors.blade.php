@extends('admin.layout')

@section('title', 'Gestion des Médecins')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des médecins</h3>
        <button class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Ajouter
        </button>
    </div>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Spécialité</th>
                    <th>Patients suivis</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doc)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 32px; height: 32px; background: #e0e7ff; color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem;">
                                {{ substr($doc->nom, 0, 1) }}
                            </div>
                            <span style="font-weight: 500;">{{ $doc->nom }} {{ $doc->prenom }}</span>
                        </div>
                    </td>
                    <td>{{ $doc->speciality ? $doc->speciality->nom : 'Généraliste' }}</td>
                    <td>-</td> <!-- Pas encore de logique de comptage de patients -->
                    <td>
                        <span class="status-badge status-success">Actif</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <button class="action-btn" title="Planning"><i class="fas fa-calendar-alt"></i></button>
                            <button class="action-btn" title="Éditer"><i class="fas fa-edit"></i></button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('admin.layout')

@section('title', 'Gestion des Patients')

@section('content')
<style>
    /* modal */
.modal {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    z-index: 60
}

.modal-content {
    background: var(--card);
    padding: 18px;
    border-radius: 8px;
    width: 100%;
    max-width: 520px
}

.modal-content h2 {
    margin-bottom: 10px
}

.modal-content label {
    display: block;
    margin-bottom: 8px
}

.modal-actions {
    display: flex;
    gap: 10px;
    margin-top: 12px
}
</style>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dossiers patients</h3>
        <div style="display: flex; gap: 1rem;">
            <input type="text" placeholder="Rechercher un patient..." style="padding: 0.5rem 1rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; outline: none;">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">

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
                        <div
                         style="display: flex; gap: 0.5rem;">
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
    <div class="modal" id="genericModal" aria-hidden="true">
        <div class="modal-content" id="genericContent"></div>
    </div>
    <script src="../../../js/script.js"></script>

</div>
      <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Select" class="form-label">Catégorie</label>
                            
                        </div>
                       
                        <div class="mb-3 row gy-3 align-items-center">
                            <div class="col-md-6">
                                <label>Nom <span class="required_span">*</span></label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>Prenom <span class="required_span">*</span></label>
                                <input type="text" name="prenom" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 row gy-3 align-items-center">
                            <div class="col-md-6">
                                <label>Telephone <span class="required_span">*</span></label>
                                <input type="text" name="telephone" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="Select" class="form-label" name="email">Email</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layout')

@section('title', 'Gestion des Spécialités')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem;">
    <!-- Add New Card -->
    <div style="background: white; border: 2px dashed #e5e7eb; border-radius: 1rem; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--primary)'; this.style.backgroundColor='#eff6ff'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.backgroundColor='white'">
        <i class="fas fa-plus-circle" style="font-size: 2rem; color: var(--primary); margin-bottom: 1rem;"></i>
        <span style="font-weight: 600; color: var(--primary);">Ajouter une spécialité</span>
    </div>

    @foreach($specialties as $spec)
    <div class="card" style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div style="width: 48px; height: 48px; background: #e0e7ff; color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                <i class="fas fa-stethoscope"></i>
            </div>
            <button class="action-btn" title="Options"><i class="fas fa-ellipsis-v"></i></button>
        </div>
        <div>
            <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.25rem;">{{ $spec->nom }}</h3>
            <p style="color: var(--secondary); font-size: 0.9rem;">{{ $spec->medecins_count }} médecins</p>
        </div>
    </div>
    @endforeach
</div>
@endsection

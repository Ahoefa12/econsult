@extends('doctor.layout')

@section('title', 'Mes Patients')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liste de mes patients</h3>
            <div style="color: var(--secondary); font-size: 0.875rem;">
                {{ $patients->count() }} patient(s)
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Nom complet</th>
                        <th>Contact</th>
                        <th>Nombre de consultations</th>
                        <th>Dernière consultation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div
                                        style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                        {{ substr($patient->prenom, 0, 1) }}{{ substr($patient->nom, 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600;">{{ $patient->prenom }} {{ $patient->nom }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.875rem;">
                                    <i class="fas fa-phone"></i> {{ $patient->telephone }}<br>
                                    <i class="fas fa-envelope"></i> {{ $patient->email }}
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-success">
                                    {{ $patient->total_appointments }} consultation(s)
                                </span>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($patient->last_appointment)->translatedFormat('d M Y') }}
                            </td>
                            <td>
                                <a href="{{ route('doctor.patients.details', $patient->email) }}" class="action-btn"
                                    title="Voir l'historique">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: var(--secondary);">
                                <i class="fas fa-users"
                                    style="font-size: 3rem; opacity: 0.3; display: block; margin-bottom: 1rem;"></i>
                                Aucun patient pour le moment
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
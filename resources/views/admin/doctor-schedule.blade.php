@extends('admin.layout')

@section('title', 'Agenda - ' . $doctor->nom . ' ' . $doctor->prenom)
@section('content')
    <style>
        .schedule-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--gray-200);
            border-radius: 0.5rem;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .day-schedule {
            background: var(--gray-100);
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
        }

        .day-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .day-name {
            font-weight: 600;
            color: var(--dark);
            text-transform: capitalize;
        }

        .time-slot {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
            align-items: center;
        }

        .btn-small {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .exception-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .exception-item {
            background: var(--gray-100);
            padding: 1rem;
            border-radius: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .exception-info {
            flex: 1;
        }

        .exception-date {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }

        .exception-type {
            font-size: 0.85rem;
            color: var(--secondary);
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        @media (max-width: 1024px) {
            .schedule-container {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="card" style="margin-bottom: 2rem;">
        <div class="card-header">
            <div>
                <h3 class="card-title">Dr. {{ $doctor->nom }} {{ $doctor->prenom }}</h3>
                <p style="margin: 0.25rem 0 0 0; color: var(--secondary); font-size: 0.9rem;">
                    {{ $doctor->speciality->nom ?? 'Spécialité non définie' }}
                </p>
            </div>
            <a href="{{ route('admin.doctors') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="schedule-container">
        <!-- Configuration des horaires hebdomadaires -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Horaires de travail</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.doctors.schedule.update', $doctor->id) }}" method="POST" id="scheduleForm">
                    @csrf
                    <input type="hidden" name="horaires_travail" id="horaires_travail_input">

                    @php
                        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                        $horaires = $doctor->horaires_travail ?? [];
                    @endphp

                    @foreach($jours as $jour)
                        <div class="day-schedule">
                            <div class="day-header">
                                <span class="day-name">{{ ucfirst($jour) }}</span>
                                <button type="button" class="btn btn-small btn-success" onclick="addTimeSlot('{{ $jour }}')">
                                    <i class="fas fa-plus"></i> Ajouter
                                </button>
                            </div>
                            <div id="slots-{{ $jour }}">
                                @if(isset($horaires[$jour]) && is_array($horaires[$jour]))
                                    @foreach($horaires[$jour] as $index => $slot)
                                        <div class="time-slot">
                                            <input type="time" class="form-control" value="{{ $slot['debut'] ?? '' }}"
                                                data-jour="{{ $jour }}" data-type="debut">
                                            <input type="time" class="form-control" value="{{ $slot['fin'] ?? '' }}"
                                                data-jour="{{ $jour }}" data-type="fin">
                                            <button type="button" class="btn btn-small btn-danger" onclick="removeTimeSlot(this)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer les horaires
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gestion des exceptions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Exceptions et congés</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.doctors.exceptions.add', $doctor->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="conge">Congé</option>
                            <option value="fermeture">Fermeture</option>
                            <option value="disponible">Disponibilité exceptionnelle</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="heure_debut">Heure de début (optionnel - toute la journée si vide)</label>
                        <input type="time" id="heure_debut" name="heure_debut" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="heure_fin">Heure de fin</label>
                        <input type="time" id="heure_fin" name="heure_fin" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="motif">Motif</label>
                        <textarea id="motif" name="motif" class="form-control" rows="3"
                            placeholder="Raison de l'indisponibilité..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ajouter l'exception
                    </button>
                </form>

                @if($doctor->disponibilites->count() > 0)
                    <hr style="margin: 2rem 0; border: none; border-top: 1px solid var(--gray-200);">
                    <h4 style="margin-bottom: 1rem; font-size: 1rem; font-weight: 600;">Exceptions planifiées</h4>
                    <div class="exception-list">
                        @foreach($doctor->disponibilites as $exception)
                            <div class="exception-item">
                                <div class="exception-info">
                                    <div class="exception-date">
                                        {{ \Carbon\Carbon::parse($exception->date)->format('d/m/Y') }}
                                        @if($exception->heure_debut && $exception->heure_fin)
                                            - {{ $exception->heure_debut }} à {{ $exception->heure_fin }}
                                        @else
                                            - Toute la journée
                                        @endif
                                    </div>
                                    <div class="exception-type">
                                        <span class="status-badge 
                                                    @if($exception->type === 'conge') status-warning
                                                    @elseif($exception->type === 'fermeture') status-danger
                                                    @else status-success
                                                    @endif">
                                            {{ ucfirst($exception->type) }}
                                        </span>
                                        @if($exception->motif)
                                            - {{ $exception->motif }}
                                        @endif
                                    </div>
                                </div>
                                <form action="{{ route('admin.doctors.exceptions.remove', [$doctor->id, $exception->id]) }}"
                                    method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn"
                                        onclick="return confirm('Supprimer cette exception ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <script>
        function addTimeSlot(jour) {
            const container = document.getElementById(`slots-${jour}`);
            const slotHtml = `
                <div class="time-slot">
                    <input type="time" class="form-control" data-jour="${jour}" data-type="debut">
                    <input type="time" class="form-control" data-jour="${jour}" data-type="fin">
                    <button type="button" class="btn btn-small btn-danger" onclick="removeTimeSlot(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', slotHtml);
        }

        function removeTimeSlot(button) {
            button.closest('.time-slot').remove();
        }

        document.getElementById('scheduleForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const horaires = {};
            const jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

            jours.forEach(jour => {
                const slots = [];
                const container = document.getElementById(`slots-${jour}`);
                const timeSlots = container.querySelectorAll('.time-slot');

                timeSlots.forEach(slot => {
                    const debut = slot.querySelector('[data-type="debut"]').value;
                    const fin = slot.querySelector('[data-type="fin"]').value;

                    if (debut && fin) {
                        slots.push({ debut, fin });
                    }
                });

                if (slots.length > 0) {
                    horaires[jour] = slots;
                }
            });

            document.getElementById('horaires_travail_input').value = JSON.stringify(horaires);
            this.submit();
        });
    </script>

@endsection
@extends('admin.layout')

@section('title', 'Paramètres')

@section('content')
<div style="max-width: 800px;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Configuration générale</h3>
        </div>
        <div style="padding: 1.5rem;">
            <form>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Nom de la plateforme</label>
                    <input type="text" value="E-Consult" style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; outline: none;">
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Email de contact</label>
                        <input type="email" value="contact@econsult.com" style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Téléphone</label>
                        <input type="text" value="+228 00 00 00 00" style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; outline: none;">
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 500; margin-bottom: 0.5rem;">Préférences de notification</label>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                            <input type="checkbox" checked style="width: 16px; height: 16px;">
                            <span>Notifier les médecins par email lors d'un nouveau rendez-vous</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                            <input type="checkbox" checked style="width: 16px; height: 16px;">
                            <span>Envoyer un rappel SMS aux patients 24h avant</span>
                        </label>
                    </div>
                </div>

                <button type="button" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</div>
@endsection

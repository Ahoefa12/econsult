<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous confirmé</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .content {
            padding: 30px 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            background-color: #ecfdf5;
            color: #10b981;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .appointment-details {
            background-color: #f8fafc;
            border-left: 4px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #64748b;
            min-width: 140px;
        }

        .detail-value {
            color: #1e293b;
            font-weight: 500;
        }

        .success-box {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }

        .success-box p {
            margin: 0;
            color: #065f46;
            font-size: 14px;
        }

        .reminder-box {
            background-color: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }

        .reminder-box h4 {
            margin: 0 0 10px 0;
            color: #9a3412;
        }

        .reminder-box ul {
            margin: 0;
            padding-left: 20px;
            color: #9a3412;
        }

        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }

        .footer a {
            color: #10b981;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>✅ Rendez-vous confirmé</h1>
            <p>E-Consult - Plateforme de consultation médicale</p>
        </div>

        <div class="content">
            <h2 style="color: #1e293b; margin-top: 0;">Bonjour {{ $rendezVous->prenom }} {{ $rendezVous->nom }},</h2>

            <p>Excellente nouvelle ! Votre rendez-vous a été <strong>confirmé</strong> par le médecin.</p>

            <span class="status-badge">✅ Confirmé</span>

            <div class="appointment-details">
                <h3 style="margin-top: 0; color: #1e293b;">Détails du rendez-vous</h3>

                <div class="detail-row">
                    <span class="detail-label">👨‍⚕️ Médecin :</span>
                    <span class="detail-value">Dr. {{ $medecin->prenom }} {{ $medecin->nom }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">🏥 Spécialité :</span>
                    <span class="detail-value">{{ $medecin->speciality->nom ?? 'Généraliste' }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">📅 Date :</span>
                    <span
                        class="detail-value">{{ \Carbon\Carbon::parse($rendezVous->date_heure)->translatedFormat('l d F Y') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">🕐 Heure :</span>
                    <span
                        class="detail-value">{{ \Carbon\Carbon::parse($rendezVous->date_heure)->format('H:i') }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">📍 Adresse :</span>
                    <span class="detail-value">{{ $medecin->adresse_cabinet }}</span>
                </div>

                <div class="detail-row">
                    <span class="detail-label">⏱️ Durée :</span>
                    <span class="detail-value">{{ $rendezVous->duree_minutes }} minutes</span>
                </div>
            </div>

            <div class="success-box">
                <p><strong>🎉 Votre rendez-vous est confirmé !</strong> Nous vous attendons à la date et l'heure
                    indiquées ci-dessus.</p>
            </div>

            <div class="reminder-box">
                <h4>📋 Rappels importants :</h4>
                <ul>
                    <li>Arrivez 10 minutes avant l'heure du rendez-vous</li>
                    <li>Apportez votre carte d'identité et votre carte vitale</li>
                    <li>Préparez vos documents médicaux si nécessaire</li>
                    <li>En cas d'empêchement, prévenez au plus tôt</li>
                </ul>
            </div>

            <p>Si vous avez des questions, n'hésitez pas à contacter le cabinet au
                <strong>{{ $medecin->telephone }}</strong>.</p>

            <p style="margin-top: 30px;">
                À bientôt,<br>
                <strong>L'équipe E-Consult</strong>
            </p>
        </div>

        <div class="footer">
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
            <p>© {{ date('Y') }} E-Consult - Tous droits réservés</p>
            <p><a href="#">Politique de confidentialité</a> | <a href="#">Conditions d'utilisation</a></p>
        </div>
    </div>
</body>

</html>
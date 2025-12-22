<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous annulé</title>
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
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
            background-color: #fef2f2;
            color: #ef4444;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .appointment-details {
            background-color: #f8fafc;
            border-left: 4px solid #ef4444;
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

        .info-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }

        .info-box p {
            margin: 0;
            color: #1e40af;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }

        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }

        .footer a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>❌ Rendez-vous annulé</h1>
            <p>E-Consult - Plateforme de consultation médicale</p>
        </div>

        <div class="content">
            <h2 style="color: #1e293b; margin-top: 0;">Bonjour {{ $rendezVous->prenom }} {{ $rendezVous->nom }},</h2>

            <p>Nous vous informons que votre rendez-vous a été <strong>annulé</strong>.</p>

            <span class="status-badge">❌ Annulé</span>

            <div class="appointment-details">
                <h3 style="margin-top: 0; color: #1e293b;">Détails du rendez-vous annulé</h3>

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
            </div>

            <div class="info-box">
                <p><strong>💡 Besoin de reprendre rendez-vous ?</strong> Vous pouvez réserver un nouveau créneau à tout
                    moment sur notre plateforme E-Consult.</p>
            </div>

            <p>Si vous avez des questions concernant cette annulation, n'hésitez pas à nous contacter.</p>

            <p style="margin-top: 30px;">
                Cordialement,<br>
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
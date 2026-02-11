@extends('layout.Layout')

@section('title', 'Politique de Confidentialité')

@section('content')
    <div class="container"
        style="max-width: 800px; margin: 50px auto; padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333;">
        <h1 style="color: #2c3e50; text-align: center; margin-bottom: 30px;">Politique de Confidentialité</h1>

        <section style="margin-bottom: 20px;">
            <h2 style="color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">1. Introduction</h2>
            <p>
                Bienvenue sur E-Consult. La protection de vos données personnelles est une priorité pour nous.
                Cette politique de confidentialité explique comment nous collectons, utilisons, divulguons et protégeons vos
                informations lorsque vous utilisez notre plateforme.
            </p>
        </section>

        <section style="margin-bottom: 20px;">
            <h2 style="color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">2. Collecte des Informations
            </h2>
            <p>Nous collectons les types d'informations suivants :</p>
            <ul style="list-style-type: disc; margin-left: 20px;">
                <li><strong>Informations personnelles :</strong> Nom, prénom, adresse e-mail, numéro de téléphone, date de
                    naissance.</li>
                <li><strong>Informations médicales :</strong> Historique des rendez-vous, médecins consultés (nous ne
                    stockons pas les détails des consultations médicales à moins que vous ne les fournissiez explicitement).
                </li>
                <li><strong>Données techniques :</strong> Adresse IP, type de navigateur, pages visitées.</li>
            </ul>
        </section>

        <section style="margin-bottom: 20px;">
            <h2 style="color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">3. Utilisation des Données
            </h2>
            <p>Vos données sont utilisées pour :</p>
            <ul style="list-style-type: disc; margin-left: 20px;">
                <li>Gérer vos prises de rendez-vous médicaux.</li>
                <li>Vous envoyer des notifications et rappels de rendez-vous.</li>
                <li>Améliorer nos services et votre expérience utilisateur.</li>
                <li>Assurer la sécurité de la plateforme.</li>
            </ul>
        </section>

        <section style="margin-bottom: 20px;">
            <h2 style="color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">4. Partage des Informations
            </h2>
            <p>
                Nous ne vendons ni ne louons vos données personnelles. Vos informations sont partagées uniquement avec :
            </p>
            <ul style="list-style-type: disc; margin-left: 20px;">
                <li>Les professionnels de santé avec qui vous prenez rendez-vous.</li>
                <li>Les prestataires de services techniques (hébergement, maintenance) sous obligation de confidentialité.
                </li>
                <li>Les autorités légales si la loi l'exige.</li>
            </ul>
        </section>

        <section style="margin-bottom: 20px;">
            <h2 style="color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">5. Sécurité des Données</h2>
            <p>
                Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles appropriées pour protéger vos
                données contre l'accès non autorisé, la modification, la divulgation ou la destruction.
            </p>
        </section>

        <section style="margin-bottom: 20px;">
            <h2 style="color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">6. Vos Droits</h2>
            <p>
                Conformément à la réglementation en vigueur, vous disposez d'un droit d'accès, de rectification, de
                suppression et de portabilité de vos données.
                Pour exercer ces droits, vous pouvez nous contacter à l'adresse suivante : contact@e-consult.com.
            </p>
        </section>

        <section style="margin-bottom: 20px;">
            <h2 style="color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">7. Cookies</h2>
            <p>
                Notre site utilise des cookies pour améliorer votre expérience de navigation. Vous pouvez configurer votre
                navigateur pour refuser les cookies, mais cela pourrait limiter certaines fonctionnalités du site.
            </p>
        </section>

        <section style="margin-bottom: 20px;">
            <h2 style="color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">8. Modifications</h2>
            <p>
                Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. Les modifications
                seront publiées sur cette page avec la date de mise à jour.
            </p>
        </section>

        <div style="margin-top: 40px; text-align: center; color: #7f8c8d; font-size: 0.9em;">
            <p>Dernière mise à jour : Février 2026</p>
        </div>
    </div>
@endsection
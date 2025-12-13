@extends('layout.Layout')

@section('content')
    <!-- HERO SECTION -->
    <div class="contact-hero">
        <div class="hero-content">
            <h1>Contactez-nous</h1>
            <p>Une question ? Besoin d'aide pour prendre rendez-vous ? Notre équipe est là pour vous accompagner.</p>
        </div>
    </div>

    <!-- MAIN CONTENT GRID -->
    <div class="contact-container">
        
        <!-- INFO SIDE -->
        <div class="contact-info-wrapper">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="info-details">
                    <h3>Notre Adresse</h3>
                    <p>123 Avenue de la Paix,<br>Lomé, Togo</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="info-details">
                    <h3>Téléphone</h3>
                    <p>+228 90 00 00 00<br>+228 22 22 22 22</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="info-details">
                    <h3>Email</h3>
                    <p>contact@e-consult.com<br>support@e-consult.com</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="info-details">
                    <h3>Heures d'ouverture</h3>
                    <p>Lundi - Vendredi: 8h - 18h<br>Samedi: 9h - 13h</p>
                </div>
            </div>
        </div>

        <!-- FORM SIDE -->
        <div class="contact-form-wrapper">
            <div class="form-header">
                <h2>Envoyez-nous un message</h2>
                <p>Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
            </div>

            <form action="/contact" method="post" class="modern-form">
                @csrf
                <div class="form-row">
                    <div class="input-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" placeholder="Votre nom" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Adresse E-mail</label>
                        <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="subject">Sujet</label>
                    <input type="text" id="subject" name="subject" placeholder="L'objet de votre message" required>
                </div>

                <div class="input-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Comment pouvons-nous vous aider ?" required></textarea>
                </div>

                <button type="submit" class="submit-btn">Envoyer le message <i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </div>

    <!-- FOOTER IS INCLUDED IN LAYOUT OR NEEDS TO BE HERE? -->
    <!-- The previous file had the footer explicitly. Let's look at Layout.blade.php again to see if it has a footer. -->
    <!-- Answer: Layout.blade.php does NOT have a footer. So I must include it here or create a partial. -->
    <!-- For consistency with the previous file, I will keep the footer here, but maybe I should have refactored it to Layout? -->
    <!-- The user asked to improve THIS page, not refactor the whole site. I will include the footer code here as it was before, but maybe cleaner. -->
    
    <!-- MAP SECTION -->
    <div class="contact-map-section">
        <div class="map-wrapper">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15866.722667104997!2d1.2064972!3d6.1725556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023e1c113185419%3A0x3224b5422caf411d!2zTG9tw6ksIFRvZ28!5e0!3m2!1sfr!2s!4v1700000000000!5m2!1sfr!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

     <footer class="footer">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-col">
                    <div class="footer-logo">
                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966327.png" alt="logo">
                        <span>E-Consult</span>
                    </div>
                    <p class="footer-desc">
                        Votre plateforme de confiance pour la prise de rendez-vous médicaux en ligne. Simple, rapide et sécurisé.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="icon fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="icon fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="icon fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="icon fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Liens Rapides</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Accueil</a></li>
                        <li><a href="{{ url('/specialites/index') }}">Spécialités</a></li>
                        <li><a href="{{ url('/comment-ca-marche') }}">Comment ça marche</a></li>
                        <li><a href="{{ url('/contactez-nous') }}">Contactez-nous</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i> Lomé, Togo</li>
                        <li><i class="fa-solid fa-phone"></i> +228 90 00 00 00</li>
                        <li><i class="fa-solid fa-envelope"></i> contact@e-consult.com</li>
                    </ul>
                </div>
               
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 E-Consult. Tous droits réservés.</p>
            </div>
        </div>
    </footer> 
@endsection
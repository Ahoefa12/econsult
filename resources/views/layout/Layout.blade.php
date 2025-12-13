<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MediConsult' }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
    <link rel="stylesheet" href="{{ asset('css/specialite.index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment-ca-marche.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">

</head>

<body>

    <!-- NAVBAR -->
    <header class="navbar">
        <div class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/2966/2966327.png" alt="logo">
            <span>E-Consult</span>
        </div>

        <nav>
            <a href="{{ url('/') }}">Accueil</a>
            <a href="{{ url('/specialites/index') }}">Spécialités</a>
            <a href="{{ url('/comment-ca-marche') }}">Comment ça marche</a>
            <a href="{{ url('/contactez-nous') }}">Contactez-nous</a>
        </nav>

        <a class="btn-primary" href="{{ url('/rendez-vous') }}">Rendez-vous</a>
    </header>

    
    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>

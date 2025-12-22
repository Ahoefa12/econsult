<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Espace Médecin</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --secondary: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --light: #f1f5f9;
            --white: #ffffff;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-800: #1f2937;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--light);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--white);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            border-right: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid var(--gray-100);
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
        }

        .doctor-info {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-bottom: 1px solid var(--gray-100);
        }

        .doctor-info h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .doctor-info p {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .nav-menu {
            padding: 1.5rem 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            text-decoration: none;
            color: var(--secondary);
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .nav-item:hover {
            background-color: var(--gray-100);
            color: var(--primary);
        }

        .nav-item.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: var(--white);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 1.75rem;
            color: var(--dark);
            font-weight: 600;
        }

        .content {
            padding: 2rem;
            flex: 1;
        }

        /* Cards */
        .card {
            background-color: var(--white);
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--gray-300);
            color: var(--secondary);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: var(--gray-100);
        }

        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.875rem;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Status badges */
        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Action buttons */
        .action-btn {
            padding: 0.5rem;
            background: transparent;
            border: none;
            color: var(--secondary);
            cursor: pointer;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }

        .action-btn:hover {
            background-color: var(--gray-100);
            color: var(--primary);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand">
            <div class="brand-logo">
                <i class="fas fa-stethoscope"></i>
            </div>
            <span class="brand-text">E-Consult</span>
        </div>

        <div class="doctor-info">
            <h3>Dr. {{ $doctor->prenom }} {{ $doctor->nom }}</h3>
            <p>{{ $doctor->speciality->nom ?? 'Médecin' }}</p>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('doctor.dashboard') }}"
                class="nav-item {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="{{ route('doctor.appointments') }}"
                class="nav-item {{ request()->routeIs('doctor.appointments*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Rendez-vous</span>
            </a>
            <a href="{{ route('doctor.patients') }}"
                class="nav-item {{ request()->routeIs('doctor.patients*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Patients</span>
            </a>
            <a href="{{ route('doctor.schedule') }}"
                class="nav-item {{ request()->routeIs('doctor.schedule*') ? 'active' : '' }}">
                <i class="fas fa-clock"></i>
                <span>Mon agenda</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('doctor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-item"
                    style="width: 100%; border: none; background: none; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>@yield('title', 'Dashboard')</h1>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>

</html>
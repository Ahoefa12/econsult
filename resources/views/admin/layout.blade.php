<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - E-Consult</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
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
            color: var(--dark);
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
            font-weight: 500;
        }

        .nav-item:hover,
        .nav-item.active {
            background-color: #eff6ff;
            color: var(--primary);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
        }

        .user-profile {
            padding: 1.5rem;
            border-top: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--gray-200);
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info h4 {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .user-info p {
            font-size: 0.75rem;
            color: var(--secondary);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            width: calc(100% - var(--sidebar-width));
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--gray-200);
            color: var(--secondary);
        }

        .btn-outline:hover {
            border-color: var(--secondary);
            color: var(--dark);
        }

        /* Cards and Stats */
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-icon.blue {
            background-color: #eff6ff;
            color: var(--primary);
        }

        .stat-icon.green {
            background-color: #ecfdf5;
            color: var(--success);
        }

        .stat-icon.orange {
            background-color: #fff7ed;
            color: var(--warning);
        }

        .stat-icon.purple {
            background-color: #f5f3ff;
            color: #8b5cf6;
        }

        .stat-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-info p {
            font-size: 0.875rem;
            color: var(--secondary);
        }

        /* Common Table Styles */
        .card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid var(--gray-100);
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-weight: 600;
            color: var(--dark);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem 1.5rem;
            background-color: var(--gray-100);
            font-weight: 600;
            color: var(--secondary);
            font-size: 0.875rem;
        }

        td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            color: var(--gray-800);
            font-size: 0.9rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-success {
            background-color: #ecfdf5;
            color: var(--success);
        }

        .status-warning {
            background-color: #fff7ed;
            color: var(--warning);
        }

        .status-danger {
            background-color: #fef2f2;
            color: var(--danger);
        }

        .status-neutral {
            background-color: #f3f4f6;
            color: var(--secondary);
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--gray-200);
            background: white;
            color: var(--secondary);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .action-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            animation: slideDown 0.3s ease-out;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: var(--success);
            border: 1px solid var(--success);
        }

        .alert-error {
            background-color: #fef2f2;
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-logo">
                <i class="fas fa-heart-pulse"></i>
            </div>
            <div class="brand-text">E-Consult</div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="{{ route('admin.appointments') }}"
                class="nav-item {{ request()->routeIs('admin.appointments') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Rendez-vous</span>
            </a>
            <a href="{{ route('admin.doctors') }}"
                class="nav-item {{ request()->routeIs('admin.doctors') ? 'active' : '' }}">
                <i class="fas fa-user-md"></i>
                <span>Médecins</span>
            </a>
            <a href="{{ route('admin.patients') }}"
                class="nav-item {{ request()->routeIs('admin.patients') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Patients</span>
            </a>
            <a href="{{ route('admin.specialties') }}"
                class="nav-item {{ request()->routeIs('admin.specialties') ? 'active' : '' }}">
                <i class="fas fa-stethoscope"></i>
                <span>Spécialités</span>
            </a>
            <a href="{{ route('admin.settings') }}"
                class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Paramètres</span>
            </a>
        </nav>

        <div class="user-profile">
            <div class="avatar">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=2563eb&color=fff" alt="Admin">
            </div>
            <div class="user-info">
                <h4>Administrateur</h4>
                <p>admin@econsult.com</p>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin-left: auto;">
                @csrf
                <button type="submit" class="action-btn" title="Déconnexion"
                    style="color: #ef4444; background: none; border: none; cursor: pointer; padding: 0.5rem;">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="header">
            <h1 class="page-title">@yield('title', 'Tableau de bord')</h1>
            <div class="header-actions">
                <button class="btn btn-outline">
                    <i class="fas fa-bell"></i>
                </button>
                <a href="{{ route('Accueil') }}" class="btn btn-outline" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    Voir le site
                </a>
            </div>
        </header>

        @yield('content')
    </main>

    <script>
        // Simple mobile menu toggle logic if needed
    </script>
</body>

</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PT MMID Production Scheduler') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <!--<img src="{{ asset('images/logo.png') }}" alt="PT XYZ" class="logo">-->
                    <span class="logo-text">PT XYZ</span>
                </div>
                <button class="sidebar-toggle d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="sidebar-menu">
                <div class="menu-header">MAIN MENU</div>
                <ul class="menu-items">
                    @auth
                        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class="menu-link">
                                <i class="menu-icon fas fa-tachometer-alt"></i>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('production-schedules.*') ? 'active' : '' }}">
                            <a href="{{ route('production-schedules.index') }}" class="menu-link">
                                <i class="menu-icon fas fa-calendar-alt"></i>
                                <span class="menu-text">Jadwal Produksi</span>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                            <a href="{{ route('tasks.index') }}" class="menu-link">
                                <i class="menu-icon fas fa-tasks"></i>
                                <span class="menu-text">Tugas</span>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                            <a href="{{ route('reports.index') }}" class="menu-link">
                                <i class="menu-icon fas fa-file-alt"></i>
                                <span class="menu-text">Laporan</span>
                            </a>
                        </li>
                        @if (Auth::user()->hasRole('admin'))
                            <div class="menu-header">ADMIN AREA</div>
                            <li class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                <a href="{{ route('users.index') }}" class="menu-link">
                                    <i class="menu-icon fas fa-users"></i>
                                    <span class="menu-text">Pengguna</span>
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>

            <div class="sidebar-footer">
                <div class="app-version">Production Scheduler v1.0</div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="navbar-left">
                    <button class="sidebar-toggle d-none d-md-block" id="sidebarToggleDesktop">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="navbar-right">
                    @auth

                        <div class="dropdown user-dropdown">
                            <button class="user-dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-name">{{ Auth::user()->name }}</div>
                                    <div class="user-role">{{ ucfirst(Auth::user()->role->name) }}</div>
                                </div>
                                <i class="fas fa-chevron-down ms-2"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </nav>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Alert Messages -->
                <div class="alert-container">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="alert-content">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="alert-content">
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="alert-content">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <!-- Main Content -->
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="app-footer">
                <div class="footer-left">
                    &copy; {{ date('Y') }} PT XYZ Industrial Development
                </div>
                <div class="footer-right">
                    <a href="#" class="footer-link">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                </div>
            </footer>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    @yield('scripts')
</body>
</html>

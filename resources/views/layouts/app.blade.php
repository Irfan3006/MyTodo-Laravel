<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'To-Do List') - MyTodo</title>
    
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <script nonce="{{ $cspNonce }}">
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: #0d6efd;
            --deep-blue: #0a58ca;
            --soft-blue: #e7f1ff;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --transition-speed: 0.3s;
        }

        [data-bs-theme="dark"] {
            --primary-blue: #3d8bfd;
            --deep-blue: #0b5ed7;
            --soft-blue: #1e293b;
            --glass-bg: rgba(15, 23, 42, 0.8);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            transition: background-color var(--transition-speed), color var(--transition-speed);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            backdrop-filter: blur(10px);
            background-color: var(--glass-bg) !important;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 0.75rem 0;
            z-index: 1030;
        }

        [data-bs-theme="dark"] .navbar {
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--primary-blue) !important;
        }
        
        .card {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.04);
            background-color: var(--bs-card-bg);
            overflow: hidden;
        }

        [data-bs-theme="dark"] .card {
            border-color: rgba(255,255,255,0.05);
        }

        .btn-primary {
            background-color: var(--primary-blue);
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: var(--deep-blue);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
        }
        
        .todo-item {
            transition: background-color 0.2s;
        }
        
        .todo-item:hover {
            background-color: var(--soft-blue);
        }

        .completed {
            text-decoration: line-through;
            opacity: 0.6;
        }
        
        #dark-mode-toggle-wrapper {
            background: var(--soft-blue);
            padding: 5px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .container { padding-left: 20px; padding-right: 20px; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <div class="bg-primary text-white p-2 rounded-3 me-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="fas fa-check-double fa-sm"></i>
                </div>
                MyTodo
            </a>
            
            <div class="d-flex align-items-center d-lg-none">
                <div id="dark-mode-toggle-wrapper" class="me-2">
                    <i class="fas fa-sun text-warning small"></i>
                    <div class="form-check form-switch p-0 m-0" style="min-height: auto;">
                        <input class="form-check-input ms-0 dark-mode-toggle" type="checkbox" role="switch">
                    </div>
                    <i class="fas fa-moon text-primary small"></i>
                </div>
                <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->is('dashboard') ? 'text-primary' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium {{ request()->is('todos*') ? 'text-primary' : '' }}" href="{{ route('todos.index') }}">Tugas Saya</a>
                        </li>
                    @endauth
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <div id="dark-mode-toggle-wrapper" class="d-none d-lg-flex">
                        <i class="fas fa-sun text-warning small"></i>
                        <div class="form-check form-switch p-0 m-0" style="min-height: auto;">
                            <input class="form-check-input ms-0 dark-mode-toggle" type="checkbox" role="switch">
                        </div>
                        <i class="fas fa-moon text-primary small"></i>
                    </div>

                    <ul class="navbar-nav align-items-center">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link fw-medium" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item ms-lg-2">
                                <a class="btn btn-primary" href="{{ route('register') }}">Daftar Gratis</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                    <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="fas fa-user small"></i>
                                    </div>
                                    <span class="fw-medium text-body">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item py-2">
                                                <i class="fas fa-sign-out-alt me-2 text-danger"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-5 flex-grow-1">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 py-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-3 fa-lg"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 py-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-3 fa-lg"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="py-4 mt-auto border-top bg-light-subtle">
        <div class="container text-center">
            <p class="mb-1 text-secondary fw-medium">&copy; {{ date('Y') }} MyTodo App. All rights reserved.</p>
            <p class="small text-muted mb-0">Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk produktivitas Anda.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script nonce="{{ $cspNonce }}">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const toggles = $('.dark-mode-toggle');
            const htmlElement = document.documentElement;
            
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            toggles.prop('checked', currentTheme === 'dark');
            
            toggles.on('change', function() {
                const isDark = $(this).prop('checked');
                const theme = isDark ? 'dark' : 'light';
                
                htmlElement.setAttribute('data-bs-theme', theme);
                localStorage.setItem('theme', theme);
                
                toggles.prop('checked', isDark);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

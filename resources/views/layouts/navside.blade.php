<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(Request::routeIs('dashboard'))
                Dashboard
            @elseif(Request::routeIs('kelas'))
                Kelas
            @elseif(Request::routeIs('quran'))
                Quran
            @elseif(Request::routeIs('laporan'))
                Laporan
            @endif
    </title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/navside.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo-pondok.png') }}" alt="User Image" class="user-image">
                <div class="user-info-sidebar">
                    <h4 class="user-name">{{ auth()->user()->name }}</h4>
                    <span class="role">{{ auth()->user()->role }}</span>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="icon-home {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i> <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas') }}" class="icon-class {{ Request::routeIs('kelas') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark"></i> <span class="menu-text">Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('quran') }}" class="icon-setoran {{ Request::routeIs('quran') ? 'active' : '' }}">
                        <i class="bi bi-book"></i> <span class="menu-text">Quran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan') }}" class="icon-report {{ Request::routeIs('laporan') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-data"></i> <span class="menu-text">Laporan</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Top Bar -->
        <div class="top-bar" id="top-bar">
            <button class="button" onclick="toggleSidebar()">
                <span class="burger burger-3 is-closed"></span>
            </button>
            <h1 class="text-4xl uppercase font-bold">
                @if(Request::routeIs('dashboard'))
                    Dashboard
                @elseif(Request::routeIs('kelas'))
                    Kelas
                @elseif(Request::routeIs('quran'))
                    Quran
                @elseif(Request::routeIs('laporan'))
                    Laporan
                @elseif(Request::routeIs('profile'))
                    Profile
                @elseif(Request::routeIs('kelas.show'))
                    Detail Kelas
                @elseif(Request::routeIs('siswa.setoran'))
                    Setoran Hafalan
                @elseif(Request::routeIs('laporan.siswa-data'))
                    Data Perkembangan
                @endif
            </h1>
            <div class="user-info">
                <span>Welcome, {{ auth()->user()->name }}</span>
                <div class="profile-container"> 
                    <button class="profile-image">
                        <img src="{{ asset('images/logo-pondok.png') }}" alt="User Image" class="user-image-profile">
                    </button>
                    <div id="profileDropdown" class="dropdown-menu">
                        <a href="{{ route('profile') }}">Profile</a>
                        <a href="#" class="logout-btn" onclick="event.preventDefault(); handleLogout();">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content" id="content">
            @yield('content')
        </div>
    </div>

    <script>
        const AppRoutes = {
            logout: "{{ route('api.logout') }}"
        };
        const csrfToken = "{{ csrf_token() }}";
    </script>
    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    
</body>
</html>

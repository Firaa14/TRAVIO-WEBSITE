<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Travio Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            min-height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar .logo {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .logo h4 {
            color: white;
            margin: 0;
            font-weight: 700;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 0;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-left-color: var(--accent-color);
        }

        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 0;
        }

        .topbar {
            background: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .content-wrapper {
            padding: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            border-left: 4px solid var(--accent-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-icon {
            font-size: 2.5rem;
            opacity: 0.3;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card-header {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            border: none;
        }

        .btn-success {
            background: var(--success-color);
            border: none;
        }

        .btn-danger {
            background: var(--danger-color);
            border: none;
        }

        .btn-warning {
            background: var(--warning-color);
            border: none;
        }

        .badge {
            padding: 0.5rem 0.8rem;
            border-radius: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="logo">
            <h4><i class="fas fa-compass me-2"></i>TRAVIO</h4>
            <small class="text-white-50">Admin Panel</small>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>Dashboard
                </a>
            </li>
            
            <li class="nav-item">
                <h6 class="nav-header text-white-50 px-3 mt-3 mb-2">MANAJEMEN KONTEN</h6>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.destinasi.*') ? 'active' : '' }}" 
                   href="{{ route('admin.destinasi.index') }}">
                    <i class="fas fa-map-marked-alt"></i>Destinasi
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.destination.*') ? 'active' : '' }}" 
                   href="{{ route('admin.destination.index') }}">
                    <i class="fas fa-mountain"></i>Destination
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.hotel.*') ? 'active' : '' }}" 
                   href="{{ route('admin.hotel.index') }}">
                    <i class="fas fa-hotel"></i>Hotel
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.hotel-detail.*') ? 'active' : '' }}" 
                   href="{{ route('admin.hotel-detail.index') }}">
                    <i class="fas fa-building"></i>Detail Hotel
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.hotel-room.*') ? 'active' : '' }}" 
                   href="{{ route('admin.hotel-room.index') }}">
                    <i class="fas fa-bed"></i>Kamar Hotel
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.car.*') ? 'active' : '' }}" 
                   href="{{ route('admin.car.index') }}">
                    <i class="fas fa-car"></i>Mobil
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.package.*') ? 'active' : '' }}" 
                   href="{{ route('admin.package.index') }}">
                    <i class="fas fa-box"></i>Paket
                </a>
            </li>
            
            <li class="nav-item">
                <h6 class="nav-header text-white-50 px-3 mt-3 mb-2">MANAJEMEN BOOKING</h6>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" 
                   href="{{ route('admin.bookings.index') }}">
                    <i class="fas fa-calendar-check"></i>Semua Booking
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.destinasi') ? 'active' : '' }}" 
                   href="{{ route('admin.bookings.destinasi') }}">
                    <i class="fas fa-map-pin"></i>Booking Destinasi
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.destination') ? 'active' : '' }}" 
                   href="{{ route('admin.bookings.destination') }}">
                    <i class="fas fa-mountain"></i>Booking Destination
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.hotel') ? 'active' : '' }}" 
                   href="{{ route('admin.bookings.hotel') }}">
                    <i class="fas fa-bed"></i>Booking Hotel
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.car') ? 'active' : '' }}" 
                   href="{{ route('admin.bookings.car') }}">
                    <i class="fas fa-car-side"></i>Booking Mobil
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.bookings.package') ? 'active' : '' }}" 
                   href="{{ route('admin.bookings.package') }}">
                    <i class="fas fa-suitcase"></i>Booking Paket
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0">@yield('page-title')</h5>
            </div>
            
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" 
                        data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-2"></i>{{ auth('admin')->user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        // Initialize DataTables
        $(document).ready(function() {
            $('.data-table').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
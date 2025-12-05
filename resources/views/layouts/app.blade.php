<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Clinic</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS (Reusing site css nicely) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
            padding-top: 80px; /* Navbar height */
        }
        .sidebar {
            width: 250px;
            background: #ffffff; /* White background */
            color: #333; /* Dark text */
            padding: 30px 20px;
            position: fixed;
            height: calc(100vh - 80px); /* Adjust height to fit exactly under navbar */
            top: 80px;
            overflow-y: auto; /* Scrollable */
            box-shadow: 2px 0 5px rgba(0,0,0,0.05);
            z-index: 900;
        }
        .sidebar a {
            display: block;
            color: #555; /* Darker link color */
            padding: 15px;
            border-bottom: 1px solid rgba(0,0,0,0.05); /* Lighter border */
            font-weight: 500;
        }
        .sidebar a:hover, .sidebar a.active {
            color: var(--primary); /* Primary color on hover */
            background: rgba(0, 123, 255, 0.05); /* Light primary bg */
            border-radius: 5px;
        }
        .admin-content {
            flex: 1;
            margin-left: 250px;
            padding: 40px;
            background: #f1f2f6;
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .table-responsive {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--shadow);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .badge-success { background: #2ecc71; color: #fff; }
        .badge-warning { background: #f1c40f; color: #fff; }
        .action-btn {
            margin-right: 5px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 1rem;
        }
        .text-info { color: var(--primary); }
        .text-danger { color: #e74c3c; }
    </style>
</head>
<body>
    <!-- Simple Admin Navbar -->
    <nav class="navbar" style="background:var(--dark); color:white;">
        <div class="container">
            <a href="{{ route('admin.dashboard') }}" class="logo" style="color:white;">Admin Panel</a>
            <div class="nav-links">
                <a href="{{ route('home') }}" target="_blank" style="color:white;">View Site</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:white; cursor:pointer; font-size:1rem; font-family:inherit;">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="{{ route('admin.doctors.index') }}" class="{{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                <i class="fas fa-user-md"></i> Doctors
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fas fa-comments"></i> Testimonials
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i> Appointments
            </a>
            <a href="{{ route('admin.medicine_requests.index') }}" class="{{ request()->routeIs('admin.medicine_requests.*') ? 'active' : '' }}">
                <i class="fas fa-pills"></i> Medicine Requests
            </a>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fas fa-notes-medical"></i> Services
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Gallery
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Messages
            </a>
            <a href="{{ route('admin.settings.about') }}" class="{{ request()->routeIs('admin.settings.about') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i> Settings (About)
            </a>
            <a href="{{ route('admin.settings.contact') }}" class="{{ request()->routeIs('admin.settings.contact') ? 'active' : '' }}">
                <i class="fas fa-address-book"></i> Settings (Contact)
            </a>
        </div>

        <!-- Content -->
        <div class="admin-content">
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clinic & Pharmacy</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-heartbeat"></i> Chinnari Medicos
            </a>
            <div class="menu-toggle" id="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
            <div class="nav-links" id="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
                <a href="{{ route('doctors.index') }}" class="{{ request()->routeIs('doctors.index') ? 'active' : '' }}">Doctors</a>
                <a href="{{ route('testimonials.index') }}" class="{{ request()->routeIs('testimonials.index') ? 'active' : '' }}">Testimonials</a>
                <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                <a href="{{ route('medicine_requests.create') }}" class="btn" style="padding: 8px 15px; margin-left: 10px; color: white !important;">Request Medicine</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h3>Chinnari Medicos</h3>
                    <p>Providing advanced healthcare and pharmacy services with a focus on patient care.</p>
                </div>
                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul>
                         <li><a href="{{ route('home') }}">Home</a></li>
                         <li><a href="{{ route('about') }}">About Us</a></li>
                         <li><a href="{{ route('services') }}">Services</a></li>
                         <li><a href="{{ route('doctors.index') }}">Doctors</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $contactSettings['contact_address'] ?? '123 Health St, City' }}</p>
                    <p><i class="fas fa-phone"></i> {{ $contactSettings['contact_phone'] ?? '+1 234 567 890' }}</p>
                    <p><i class="fas fa-envelope"></i> {{ $contactSettings['contact_email'] ?? 'info@chinnarimedicos.com' }}</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Chinnari Medicos Clinic & Pharmacy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.getElementById('mobile-menu');
            const navLinks = document.getElementById('nav-links');

            menuToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                // Change icon
                const icon = menuToggle.querySelector('i');
                if (navLinks.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

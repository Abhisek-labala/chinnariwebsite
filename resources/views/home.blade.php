@extends('layouts.guest')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container hero-container">
        <div class="hero-content">
            <h1>Expert Care for <br> <span style="color: var(--primary);">Your Family</span></h1>
            <p>Access the best healthcare services and doctors at your fingertips. We are committed to providing top-quality medical assistance.</p>
            <a href="{{ route('doctors.index') }}" class="btn">Find a Doctor</a>
        </div>
        <div class="hero-image">
             <!-- Placeholder image for now -->
            <img src="https://img.freepik.com/free-photo/team-young-specialist-doctors-standing-corridor-hospital_1303-21199.jpg" alt="Doctors">
        </div>
    </div>
</section>

<!-- About Preview -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Who We Are</h2>
        </div>
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <p style="font-size: 1.1rem;">We are a leading healthcare provider offering comprehensive medical services. Our team of experienced professionals is dedicated to your well-being.</p>
            <br>
            <a href="{{ route('about') }}" class="btn" style="background: var(--dark);">Learn More</a>
        </div>
    </div>
</section>

<!-- Doctors Preview -->
<section class="section" style="background: #f1f2f6;">
    <div class="container">
        <div class="section-title">
            <h2>Meet Our Doctors</h2>
        </div>
        <div class="card-grid">
            @forelse($doctors->take(3) as $doctor)
            <div class="card doctor-card">
                <div class="card-img-wrapper">
                    <img src="{{ $doctor->image_path ? asset('storage/'.$doctor->image_path) : 'https://via.placeholder.com/300x250?text=Doctor' }}" alt="{{ $doctor->name }}">
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ $doctor->name }}</h3>
                    <p class="card-subtitle">{{ $doctor->specialist }}</p>
                    <p style="color:#555; font-size: 0.9rem; margin-bottom: 10px;">{{ $doctor->designation }}</p>
                    
                    @if($doctor->date)
                        <p style="font-size: 0.85rem; color: var(--primary); font-weight: 600; margin-bottom: 5px;"><i class="far fa-calendar-alt"></i> Available: {{ \Carbon\Carbon::parse($doctor->date)->format('M d, Y') }}</p>
                    @endif

                    @if($doctor->timings)
                        <p style="font-size: 0.85rem; color: #777;"><i class="far fa-clock"></i> {{ $doctor->timings }}</p>
                    @endif
                    
                    @if($doctor->bio)
                        <p style="margin-top: 10px; font-size: 0.9rem; color: #444;">{{ Str::limit($doctor->bio, 80) }}</p>
                    @endif
                    
                    <a href="{{ route('appointments.create', $doctor) }}" class="btn" style="margin-top: 20px; font-size: 0.9rem; padding: 10px 20px;">Book Appointment</a>
                </div>
            </div>
            @empty
            <p style="text-align:center; width:100%;">No doctors added yet.</p>
            @endforelse
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('doctors.index') }}" class="btn">View All Doctors</a>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Our Services</h2>
        </div>
        <div class="card-grid">
            <div class="card" style="text-align: center; padding: 40px;">
                <i class="fas fa-stethoscope" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
                <h3 class="card-title">General Checkup</h3>
                <p>Comprehensive health screening and diagnosis.</p>
            </div>
            <div class="card" style="text-align: center; padding: 40px;">
                <i class="fas fa-pills" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
                <h3 class="card-title">Pharmacy</h3>
                <p>24/7 Pharmacy with home delivery options.</p>
            </div>
            <div class="card" style="text-align: center; padding: 40px;">
                <i class="fas fa-vial" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
                <h3 class="card-title">Lab Tests</h3>
                <p>Advanced pathology lab for accurate results.</p>
            </div>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('services') }}" class="btn">View All Services</a>
        </div>
    </div>
</section>
@endsection

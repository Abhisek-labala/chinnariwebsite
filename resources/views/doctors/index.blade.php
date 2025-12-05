@extends('layouts.guest')

@section('content')
<div style="background: var(--dark); color: white; padding: 100px 0 50px; text-align: center;">
    <h1>Our Doctors</h1>
    <p>Meet Our Specialist Team</p>
</div>

<section class="section">
    <div class="container">
        <div class="card-grid">
            @forelse($doctors as $doctor)
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
            <div style="grid-column: 1 / -1; text-align: center;">
                <h3>No doctors available at the moment.</h3>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@extends('layouts.guest')

@section('content')
<div class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); height: 350px; display: flex; align-items: center; justify-content: center; color: white; text-align: center;">
    <div>
        <h1 style="font-size: 3.5rem; margin-bottom: 10px; font-weight: 800;">Our Services</h1>
        <p style="font-size: 1.3rem; opacity: 0.9;">Comprehensive Healthcare Solutions for You</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="services-grid">
            @forelse($services as $service)
            <div class="card service-card">
                <div class="icon-box">
                    @if($service->icon)
                        <i class="{{ $service->icon }}"></i>
                    @else
                        <i class="fas fa-notes-medical"></i>
                    @endif
                </div>
                <h3>{{ $service->title }}</h3>
                <p>{{ Str::limit($service->description, 100) }}</p>
                <a href="{{ route('contact') }}" class="read-more">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; color: #777;">
                <p>No services listed yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

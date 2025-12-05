@extends('layouts.guest')

@section('content')
<div class="hero-section" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); height: 350px; display: flex; align-items: center; justify-content: center; color: white; text-align: center;">
    <div>
        <h1 style="font-size: 3.5rem; margin-bottom: 10px; font-weight: 800;">Our Gallery</h1>
        <p style="font-size: 1.3rem; opacity: 0.9;">A Glimpse of Our World Class Facilities</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="gallery-grid">
            @forelse($images as $image)
            <div class="gallery-card">
                <img src="{{ asset($image->image_path) }}" alt="{{ $image->title }}">
                <div class="gallery-overlay">
                    <div class="gallery-title">{{ $image->title ?? 'Clinic Moment' }}</div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; color: #777;">
                <p>No images in gallery yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

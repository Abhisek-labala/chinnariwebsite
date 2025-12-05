@extends('layouts.guest')

@section('content')
<div class="section" style="padding-top: 120px;">
    <div class="container">
        <div class="about-section-wrapper">
            <div class="about-img-wrapper">
                @if(isset($settings['about_image']))
                    <img src="{{ asset($settings['about_image']) }}" alt="About Us" class="about-img">
                @else
                    <img src="https://images.unsplash.com/photo-1576091160550-217358c7e618?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="About Us" class="about-img">
                @endif
            </div>
            <div class="about-content">
                <h2 class="section-title" style="text-align: left; margin-bottom: 20px;">{{ $settings['about_title'] ?? 'About Our Clinic' }}</h2>
                <div style="font-size: 1.1rem; line-height: 1.8; color: #555;">
                    @if(isset($settings['about_description']))
                        {!! nl2br(e($settings['about_description'])) !!}
                    @else
                        <p>Welcome to our Pharmacy & Clinic, where your health is our priority. We are dedicated to providing top-quality healthcare services and genuine medicines to our community.</p>
                        <p>Our team of experienced doctors and pharmacists works tirelessly to ensure you receive the best care possible. From general consultations to specialized treatments, we are here for you.</p>
                        <p>We believe in a holistic approach to health, focusing not just on treating illnesses but also on preventive care and wellness.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

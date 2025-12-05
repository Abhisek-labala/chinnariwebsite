@extends('layouts.guest')

@section('content')
<div style="background: var(--dark); color: white; padding: 100px 0 50px; text-align: center;">
    <h1>Contact Us</h1>
    <p>Get in Touch</p>
</div>

<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
            <div>
                <h3>Contact Info</h3>
                <br>
                <p style="margin-bottom: 15px;"><i class="fas fa-map-marker-alt" style="color: var(--primary); width: 25px;"></i> {{ $settings['contact_address'] ?? '123 Health Villa, Medical District, City' }}</p>
                <p style="margin-bottom: 15px;"><i class="fas fa-phone" style="color: var(--primary); width: 25px;"></i> {{ $settings['contact_phone'] ?? '+1 234 567 8900' }}</p>
                <p style="margin-bottom: 15px;"><i class="fas fa-envelope" style="color: var(--primary); width: 25px;"></i> {{ $settings['contact_email'] ?? 'info@clinic.com' }}</p>
                <p style="margin-bottom: 5px;"><i class="fas fa-clock" style="color: var(--primary); width: 25px;"></i> <strong>Morning:</strong> {{ $settings['contact_timings_morning'] ?? '10:00 AM - 1:00 PM' }}</p>
                <p style="margin-bottom: 15px; margin-left: 29px;"><strong>Evening:</strong> {{ $settings['contact_timings_evening'] ?? '5:00 PM - 9:00 PM' }}</p>

                @if(isset($settings['contact_map_url']) && !empty($settings['contact_map_url']))
                    <div style="margin-top: 30px; border-radius: 10px; overflow: hidden; box-shadow: var(--shadow);">
                        <div style="width: 100%; height: 250px;">
                            {!! $settings['contact_map_url'] !!}
                        </div>
                    </div>
                @endif
            </div>
            
            <div>
                <h3>Send us a Message</h3>
                <br>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    @if(session('success'))
                        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Mobile Number" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="4" placeholder="Message" required></textarea>
                    </div>
                    <button type="submit" class="btn">Send Message</button>
                    <!-- <p style="font-size: 0.8rem; color: #777; margin-top: 10px;">* This form is for demo purposes.</p> -->
                </form>
            </div>
        </div>

        <style>
            iframe { width: 100% !important; height: 100% !important; border: 0; }
        </style>

    </div>
</section>
@endsection

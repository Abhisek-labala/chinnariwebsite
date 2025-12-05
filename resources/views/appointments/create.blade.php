@extends('layouts.guest')

@section('content')
<div class="section" style="padding-top: 120px; background: #f8f9fa;">
    <div class="container">
        <div style="max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: var(--dark); margin-bottom: 10px;">Book Appointment</h2>
                <p style="color: #666;">Schedule a visit with Dr. {{ $doctor->name }}</p>
                @if(session('success'))
                    <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-top: 10px;">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                
                <div class="form-group">
                    <label style="font-weight: 600; color: #444; margin-bottom: 5px; display: block;">Doctor</label>
                    <input type="text" class="form-control" value="{{ $doctor->name }} ({{ $doctor->specialist }})" readonly style="background: #e9ecef; cursor: not-allowed;">
                </div>

                <div class="form-group">
                    <label style="font-weight: 600; color: #444; margin-bottom: 5px; display: block;">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-control" value="{{ $doctor->date }}" readonly style="background: #e9ecef; cursor: not-allowed;">
                    <small style="color: #888;">* As per doctor's availability</small>
                </div>

                <div class="form-group">
                    <label style="font-weight: 600; color: #444; margin-bottom: 5px; display: block;">Patient Name</label>
                    <input type="text" name="patient_name" class="form-control" required placeholder="Enter full name">
                </div>

                <div class="form-group">
                    <label style="font-weight: 600; color: #444; margin-bottom: 5px; display: block;">Phone Number</label>
                    <input type="tel" name="patient_phone" class="form-control" required placeholder="Enter phone number">
                </div>

                <div class="form-group">
                    <label style="font-weight: 600; color: #444; margin-bottom: 5px; display: block;">Problem Description</label>
                    <textarea name="problem" class="form-control" rows="3" required placeholder="Briefly describe your health issue"></textarea>
                </div>

                <button type="submit" class="btn" style="width: 100%; border-radius: 10px;">Confirm Booking</button>
            </form>
        </div>
    </div>
</div>
@endsection

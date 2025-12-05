@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Edit Appointment</h2>
    <a href="{{ route('admin.appointments.index') }}" class="btn" style="background: #999;">Back</a>
</div>

<div style="background: #fff; padding: 30px; border-radius: 10px; max-width: 800px;">
    @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Doctor</label>
            <select name="doctor_id" class="form-control" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }} ({{ $doctor->specialist }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Appointment Date</label>
            <input type="date" name="appointment_date" class="form-control" required value="{{ old('appointment_date', $appointment->appointment_date) }}">
        </div>
        <div class="form-group">
            <label>Patient Name</label>
            <input type="text" name="patient_name" class="form-control" required value="{{ old('patient_name', $appointment->patient_name) }}">
        </div>
        <div class="form-group">
            <label>Patient Phone</label>
            <input type="tel" name="patient_phone" class="form-control" required value="{{ old('patient_phone', $appointment->patient_phone) }}">
        </div>
        <div class="form-group">
            <label>Problem Description</label>
            <textarea name="problem" class="form-control" rows="3" required>{{ old('problem', $appointment->problem) }}</textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="called" {{ $appointment->status == 'called' ? 'selected' : '' }}>Called</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn">Update Appointment</button>
    </form>
</div>
@endsection

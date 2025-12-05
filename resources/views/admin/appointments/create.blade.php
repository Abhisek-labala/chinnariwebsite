@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Add New Appointment</h2>
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

    <form action="{{ route('admin.appointments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Doctor</label>
            <select name="doctor_id" class="form-control" required>
                <option value="">Select Doctor</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id', request('doctor_id')) == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }} ({{ $doctor->specialist }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Appointment Date</label>
            <input type="date" name="appointment_date" class="form-control" required value="{{ old('appointment_date') }}">
        </div>
        <div class="form-group">
            <label>Patient Name</label>
            <input type="text" name="patient_name" class="form-control" required value="{{ old('patient_name', request('patient_name')) }}">
        </div>
        <div class="form-group">
            <label>Patient Phone</label>
            <input type="tel" name="patient_phone" class="form-control" required value="{{ old('patient_phone', request('patient_phone')) }}">
        </div>
        <div class="form-group">
            <label>Problem Description</label>
            <textarea name="problem" class="form-control" rows="3" required>{{ old('problem', request('problem')) }}</textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" selected>Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="btn">Create Appointment</button>
    </form>
</div>
@endsection

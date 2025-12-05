@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Appointments</h2>
    <a href="{{ route('admin.appointments.create') }}" class="btn"><i class="fas fa-plus"></i> Add New</a>
</div>

<div style="margin-bottom: 20px; background: white; padding: 20px; border-radius: 10px; box-shadow: var(--shadow);">
    <form action="{{ route('admin.appointments.index') }}" method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
        <div style="flex: 1; min-width: 200px;">
            <label style="font-weight: 600; margin-bottom: 5px; display: block;">Filter by Doctor</label>
            <select name="doctor_id" class="form-control">
                <option value="">All Doctors</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div style="flex: 1; min-width: 150px;">
            <label style="font-weight: 600; margin-bottom: 5px; display: block;">Filter by Date</label>
            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
        </div>
        <div style="flex: 1; min-width: 150px;">
            <label style="font-weight: 600; margin-bottom: 5px; display: block;">Filter by Month</label>
            <input type="month" name="month" class="form-control" value="{{ request('month') }}">
        </div>
        <div>
            <button type="submit" class="btn"><i class="fas fa-filter"></i> Filter</button>
            <a href="{{ route('admin.appointments.index') }}" class="btn" style="background: #666; margin-left: 5px;">Reset</a>
        </div>
    </form>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Patient</th>
                <th>Phone</th>
                <th>Doctor</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
            <tr>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                <td>{{ $appointment->patient_name }}</td>
                <td>{{ $appointment->patient_phone }}</td>
                <td>
                    <div style="font-weight: 600;">{{ $appointment->doctor->name }}</div>
                </td>
                <td>
                    @php
                        $statusColors = [
                            'pending' => '#ffeaa7', // Yellow
                            'completed' => '#55efc4', // Green
                            'cancelled' => '#ff7675', // Red
                            'called' => '#74b9ff', // Blue
                        ];
                        $color = $statusColors[$appointment->status] ?? '#dfe6e9';
                    @endphp
                    <span style="padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; background: {{ $color }}; color: #2d3436; font-weight: 600;">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        @if($appointment->status === 'completed')
                            <a href="{{ route('admin.appointments.create', [
                                'doctor_id' => $appointment->doctor_id, 
                                'patient_name' => $appointment->patient_name, 
                                'patient_phone' => $appointment->patient_phone,
                                'problem' => $appointment->problem
                            ]) }}" class="btn" style="padding: 5px 10px; font-size: 0.75rem; background: #6c5ce7; width: 100%; white-space: nowrap;">
                                <i class="fas fa-calendar-plus"></i> Book Next Visit
                            </a>
                        @else
                            @if($appointment->status !== 'called')
                            <form action="{{ route('admin.appointments.status', ['appointment' => $appointment, 'status' => 'called']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn" style="padding: 5px 8px; font-size: 0.7rem; background: #0984e3;" title="Mark as Called"><i class="fas fa-phone"></i></button>
                            </form>
                            @endif
                            
                            @if($appointment->status !== 'completed')
                            <form action="{{ route('admin.appointments.status', ['appointment' => $appointment, 'status' => 'completed']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn" style="padding: 5px 8px; font-size: 0.7rem; background: #00b894;" title="Mark Completed"><i class="fas fa-check"></i></button>
                            </form>
                            @endif

                            <a href="{{ route('admin.appointments.edit', $appointment) }}" class="action-btn text-info"><i class="fas fa-edit"></i></a>
                            
                            <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete appointment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn text-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 30px; color: #777;">
                    No appointments found matching your filters.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>All Doctors</h2>
    <a href="{{ route('admin.doctors.create') }}" class="btn"><i class="fas fa-plus"></i> Add New</a>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Specialist</th>
                <th>Designation</th>
                <th>Date</th>
                <th>Timings</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($doctors as $doctor)
            <tr>
                <td>
                    <img src="{{ $doctor->image_path ? asset('storage/'.$doctor->image_path) : 'https://via.placeholder.com/50' }}" alt="doc" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                </td>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->specialist }}</td>
                <td>{{ $doctor->designation }}</td>
                <td>{{ $doctor->date ? \Carbon\Carbon::parse($doctor->date)->format('M d, Y') : 'N/A' }}</td>
                <td>{{ $doctor->timings }}</td>
                <td>
                    <a href="{{ route('admin.doctors.edit', $doctor) }}" class="action-btn text-info"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn text-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">No doctors found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

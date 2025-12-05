@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Dashboard</h2>
    <div>
        <a href="{{ route('admin.doctors.create') }}" class="btn"><i class="fas fa-plus"></i> Add Doctor</a>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px;">
    <div style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: var(--shadow); text-align: center;">
        <i class="fas fa-user-md" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 10px;"></i>
        <h3>{{ \App\Models\Doctor::count() }}</h3>
        <p>Doctors</p>
    </div>
    <div style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: var(--shadow); text-align: center;">
        <i class="fas fa-comments" style="font-size: 2.5rem; color: var(--accent); margin-bottom: 10px;"></i>
        <h3>{{ \App\Models\Testimonial::count() }}</h3>
        <p>Total Testimonials</p>
    </div>
    <div style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: var(--shadow); text-align: center;">
        <i class="fas fa-check-circle" style="font-size: 2.5rem; color: #2ecc71; margin-bottom: 10px;"></i>
        <h3>{{ \App\Models\Testimonial::where('is_approved', true)->count() }}</h3>
        <p>Approved Testimonials</p>
    </div>
    <div style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: var(--shadow); text-align: center;">
        <i class="fas fa-hourglass-half" style="font-size: 2.5rem; color: #f1c40f; margin-bottom: 10px;"></i>
        <h3>{{ \App\Models\Testimonial::where('is_approved', false)->count() }}</h3>
        <p>Pending Approval</p>
    </div>
</div>

<div class="table-responsive">
    <h3 style="margin-bottom: 20px;">Recent Testimonials (Pending)</h3>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse(\App\Models\Testimonial::where('is_approved', false)->latest()->take(5)->get() as $item)
            <tr>
                <td>{{ $item->created_at->format('M d, Y') }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ Str::limit($item->message, 50) }}</td>
                <td>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn" style="padding: 5px 10px; font-size: 0.8rem;">Review</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">No pending testimonials.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

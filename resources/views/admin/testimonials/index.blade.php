@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Manage Testimonials</h2>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $testimonial)
            <tr>
                <td>{{ $testimonial->created_at->format('M d, Y') }}</td>
                <td>{{ $testimonial->name }}</td>
                <td>
                    <span style="color: #ffc107;">
                        @for($i=1; $i<=5; $i++)
                            @if($i <= $testimonial->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </span>
                    ({{ $testimonial->rating }})
                </td>
                <td>{{ $testimonial->message }}</td>
                <td>
                    @if($testimonial->is_approved)
                        <span class="badge badge-success">Approved</span>
                    @else
                        <span class="badge badge-warning">Pending</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 10px;">
                        @if(!$testimonial->is_approved)
                        <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn" style="padding: 5px 10px; font-size: 0.8rem; background: #2ecc71;"><i class="fas fa-check"></i> Approve</button>
                        </form>
                        @endif
                        
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Delete this testimonial?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn text-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">No testimonials found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Services</h2>
    <a href="{{ route('admin.services.create') }}" class="btn"><i class="fas fa-plus"></i> Add Service</a>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Icon</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td style="font-size: 1.5rem; color: #6c5ce7;">
                    @if($service->icon)
                        <i class="{{ $service->icon }}"></i>
                    @else
                        <i class="fas fa-notes-medical"></i>
                    @endif
                </td>
                <td style="font-weight: 600;">{{ $service->title }}</td>
                <td>{{ Str::limit($service->description, 60) }}</td>
                <td>
                    <div style="display: flex; gap: 5px;">
                        <a href="{{ route('admin.services.edit', $service) }}" class="action-btn text-info"><i class="fas fa-edit"></i></a>
                        
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this service?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn text-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 30px; color: #777;">
                    No services found. Add one now!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

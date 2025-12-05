@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Medicine Requests</h2>
</div>

<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Patient</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Medicines</th>
                <th>Prescription</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
            <tr>
                <td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
                <td>{{ $request->name }}</td>
                <td><a href="tel:{{ $request->phone }}">{{ $request->phone }}</a></td>
                <td>{{ $request->address ?? '-' }}</td>
                <td>
                    {{-- JSON Parsing --}}
                    @php
                        $medicines = json_decode($request->medicines, true);
                    @endphp
                    @if(is_array($medicines))
                        <ul style="padding-left: 20px; margin: 0;">
                            @foreach($medicines as $med)
                                <li>{{ $med['name'] }} (Qty: {{ $med['qty'] }})</li>
                            @endforeach
                        </ul>
                    @else
                        {{ $request->medicines }}
                    @endif
                </td>
                <td>
                    @if($request->prescription_path)
                        <a href="{{ asset($request->prescription_path) }}" target="_blank" class="btn" style="padding: 5px 10px; font-size: 0.8rem; background: #3498db;">View Image</a>
                    @else
                        <span style="color: #999;">None</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.medicine_requests.destroy', $request) }}" method="POST" onsubmit="return confirm('Delete this request?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn text-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">No medicine requests found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

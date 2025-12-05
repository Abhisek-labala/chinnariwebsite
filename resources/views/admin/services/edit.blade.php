@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Edit Service</h2>
    <a href="{{ route('admin.services.index') }}" class="btn" style="background: #999;">Back</a>
</div>

<div style="background: #fff; padding: 30px; border-radius: 10px; max-width: 800px;">
    <form action="{{ route('admin.services.update', $service) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required value="{{ $service->title }}">
        </div>
        <div class="form-group">
            <label>Icon</label>
            <div style="display: flex; align-items: center; gap: 15px;">
                <select name="icon" id="iconSelect" class="form-control" style="flex: 1;" onchange="updateIconPreview()">
                    <option value="">Select an Icon</option>
                    @php
                        $icons = [
                            'fas fa-heartbeat', 'fas fa-user-md', 'fas fa-stethoscope', 'fas fa-hospital', 'fas fa-ambulance', 
                            'fas fa-medkit', 'fas fa-pills', 'fas fa-syringe', 'fas fa-thermometer-half', 'fas fa-dna', 
                            'fas fa-virus', 'fas fa-lungs', 'fas fa-brain', 'fas fa-tooth', 'fas fa-eye', 'fas fa-bone', 
                            'fas fa-procedures', 'fas fa-x-ray', 'fas fa-baby', 'fas fa-hands-helping', 'fas fa-notes-medical',
                            'fas fa-file-medical', 'fas fa-capsules', 'fas fa-flask', 'fas fa-vial', 'fas fa-microscope',
                            'fas fa-user-nurse', 'fas fa-clinic-medical', 'fas fa-briefcase-medical', 'fas fa-first-aid',
                            'fas fa-crutch', 'fas fa-wheelchair', 'fas fa-band-aid', 'fas fa-burn', 'fas fa-diagnoses',
                            'fas fa-allergies', 'fas fa-hand-holding-medical', 'fas fa-head-side-mask', 'fas fa-pump-medical',
                            'fas fa-shield-virus', 'fas fa-soap', 'fas fa-star-of-life', 'fas fa-smoking-ban', 'fas fa-clock',
                            'fas fa-calendar-alt', 'fas fa-phone-alt', 'fas fa-envelope', 'fas fa-map-marker-alt', 'fas fa-info-circle',
                            'fas fa-check-circle', 'fas fa-leaf', 'fas fa-spa'
                        ];
                    @endphp
                    @foreach($icons as $iconClass)
                        <option value="{{ $iconClass }}" {{ $service->icon == $iconClass ? 'selected' : '' }}>
                            {{ str_replace(['fas fa-', '-'], ['', ' '], $iconClass) }}
                        </option>
                    @endforeach
                </select>
                <div id="iconPreview" style="font-size: 2rem; color: #6c5ce7; width: 50px; text-align: center;">
                    <i class="{{ $service->icon }}"></i>
                </div>
            </div>
        </div>

        <script>
            function updateIconPreview() {
                var icon = document.getElementById('iconSelect').value;
                var preview = document.getElementById('iconPreview');
                if(icon) {
                    preview.innerHTML = '<i class="' + icon + '"></i>';
                } else {
                    preview.innerHTML = '<i class="fas fa-notes-medical"></i>'; // Default fallback
                }
            }
        </script>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $service->description }}</textarea>
        </div>

        <button type="submit" class="btn">Update Service</button>
    </form>
</div>
@endsection

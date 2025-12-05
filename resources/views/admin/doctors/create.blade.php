@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Add New Doctor</h2>
    <a href="{{ route('admin.doctors.index') }}" class="btn" style="background: #999;">Back</a>
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

    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" required value="{{ old('designation') }}" placeholder="e.g. Senior Consultant">
        </div>
        <div class="form-group">
            <label>Specialist</label>
            <input type="text" name="specialist" class="form-control" required value="{{ old('specialist') }}" placeholder="e.g. Cardiologist">
        </div>
        <div class="form-group">
            <label>Available Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
        </div>
        <div class="form-group">
            <label>Timings</label>
            <input type="text" name="timings" class="form-control" value="{{ old('timings') }}" placeholder="e.g. 10:00 AM - 02:00 PM">
        </div>
        <div class="form-group">
            <label>Bio (Optional)</label>
            <textarea name="bio" class="form-control" rows="4">{{ old('bio') }}</textarea>
        </div>
        <div class="form-group">
            <label>Profile Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(this)">
            <div style="margin-top: 10px;">
                <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 100px; border-radius: 10px; border: 1px solid #ddd; padding: 2px;">
            </div>
        </div>
        <button type="submit" class="btn">Save Doctor</button>
    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var preview = document.getElementById('imagePreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

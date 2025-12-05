@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Edit Doctor</h2>
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

    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $doctor->name) }}">
        </div>
        <div class="form-group">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" required value="{{ old('designation', $doctor->designation) }}">
        </div>
        <div class="form-group">
            <label>Specialist</label>
            <input type="text" name="specialist" class="form-control" required value="{{ old('specialist', $doctor->specialist) }}">
        </div>
        <div class="form-group">
            <label>Available Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $doctor->date) }}">
        </div>
        <div class="form-group">
            <label>Timings</label>
            <input type="text" name="timings" class="form-control" value="{{ old('timings', $doctor->timings) }}">
        </div>
        <div class="form-group">
            <label>Bio (Optional)</label>
            <textarea name="bio" class="form-control" rows="4">{{ old('bio', $doctor->bio) }}</textarea>
        </div>
        <div class="form-group">
            <label>Profile Image</label>
            <div style="margin: 10px 0;">
                <img id="imagePreview" src="{{ $doctor->image_path ? asset('storage/'.$doctor->image_path) : '#' }}" width="100" style="border-radius: 5px; {{ $doctor->image_path ? '' : 'display:none;' }}">
            </div>
            <input type="file" name="image" class="form-control" onchange="previewImage(this)">
        </div>
        <button type="submit" class="btn">Update Doctor</button>
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

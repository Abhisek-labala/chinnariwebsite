@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Update About Us Page</h2>
</div>

<div style="background: #fff; padding: 30px; border-radius: 10px; max-width: 900px; box-shadow: var(--shadow);">
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label style="font-size: 1.1rem;">Page Title / Headline</label>
            <input type="text" name="about_title" class="form-control" value="{{ $settings['about_title'] ?? 'Welcome to Our Clinic' }}" required>
        </div>

        <div style="display: flex; gap: 30px; flex-wrap: wrap;">
            <div style="flex: 2; min-width: 300px;">
                <div class="form-group">
                    <label style="font-size: 1.1rem;">Description</label>
                    <textarea name="about_description" class="form-control" rows="10" required>{{ $settings['about_description'] ?? '' }}</textarea>
                    <small style="color: #666;">This content will be displayed on the public About Us page.</small>
                </div>
            </div>

            <div style="flex: 1; min-width: 250px;">
                <div class="form-group">
                    <label style="font-size: 1.1rem;">Featured Image</label>
                    @if(isset($settings['about_image']))
                        <div style="margin: 10px 0; border: 1px solid #ddd; padding: 5px; border-radius: 5px;">
                            <img src="{{ asset($settings['about_image']) }}" style="width: 100%; border-radius: 5px;">
                        </div>
                    @endif
                    <input type="file" name="about_image" class="form-control" accept="image/*">
                    <small style="color: #666;">Upload a new image to replace the current one.</small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn" style="margin-top: 20px; padding: 12px 30px; font-size: 1.1rem;">Save Changes</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Gallery Management</h2>
</div>

<!-- Upload Section -->
<div style="background: #fff; padding: 20px; border-radius: 10px; margin-bottom: 30px; box-shadow: var(--shadow);">
    <h3 style="margin-bottom: 15px; font-size: 1.2rem; color: #444;">Upload New Image</h3>
    
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
        @csrf
        <div style="flex: 1; min-width: 250px;">
            <label style="font-weight: 600; font-size: 0.9rem;">Image Title (Optional)</label>
            <input type="text" name="title" class="form-control" placeholder="Office, Equipment, Event...">
        </div>
        <div style="flex: 1; min-width: 250px;">
            <label style="font-weight: 600; font-size: 0.9rem;">Select Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn"><i class="fas fa-upload"></i> Upload</button>
    </form>
</div>

<!-- Gallery Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
    @forelse($images as $image)
        <div style="background: white; padding: 10px; border-radius: 10px; box-shadow: var(--shadow); position: relative; group">
            <div style="height: 150px; overflow: hidden; border-radius: 5px;">
                <img src="{{ asset($image->image_path) }}" alt="{{ $image->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: 0.3s; cursor: pointer;">
            </div>
            
            <div style="padding: 10px 0 0; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 0.9rem; font-weight: 600; color: #555;">{{ $image->title ?? 'Untitled' }}</span>
                
                <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" onsubmit="return confirm('Delete image?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; color: #ff7675; cursor: pointer;">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div style="grid-column: 1 / -1; text-align: center; color: #777; padding: 40px;">
            No images in gallery yet.
        </div>
    @endforelse
</div>
@endsection

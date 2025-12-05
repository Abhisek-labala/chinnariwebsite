@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Update Contact Information</h2>
</div>

<div style="background: #fff; padding: 30px; border-radius: 10px; max-width: 900px; box-shadow: var(--shadow);">
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.updateContact') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label style="font-size: 1.1rem;">Clinic Address</label>
            <textarea name="contact_address" class="form-control" rows="3" required>{{ $settings['contact_address'] ?? '' }}</textarea>
        </div>

        <div class="row" style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div class="col" style="flex: 1; min-width: 250px;">
                <div class="form-group">
                    <label style="font-size: 1.1rem;">Phone Number</label>
                    <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}" required>
                </div>
            </div>
            <div class="col" style="flex: 1; min-width: 250px;">
                <div class="form-group">
                    <label style="font-size: 1.1rem;">Public Email</label>
                    <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? '' }}" required>
                </div>
            </div>
        </div>

        <div class="row" style="display: flex; gap: 20px; flex-wrap: wrap;">
            <div class="col" style="flex: 1; min-width: 250px;">
                <div class="form-group">
                    <label style="font-size: 1.1rem;">Morning Timings</label>
                    <input type="text" name="contact_timings_morning" class="form-control" value="{{ $settings['contact_timings_morning'] ?? '' }}" required>
                    <small style="color: #666;">e.g., "10:00 AM - 1:00 PM"</small>
                </div>
            </div>
            <div class="col" style="flex: 1; min-width: 250px;">
                <div class="form-group">
                    <label style="font-size: 1.1rem;">Evening Timings</label>
                    <input type="text" name="contact_timings_evening" class="form-control" value="{{ $settings['contact_timings_evening'] ?? '' }}" required>
                    <small style="color: #666;">e.g., "5:00 PM - 9:00 PM"</small>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label style="font-size: 1.1rem;">Google Map Embed URL (src only) or Iframe</label>
            <textarea name="contact_map_url" class="form-control" rows="3" placeholder='<iframe src="..." ...></iframe> or just the URL'>{{ $settings['contact_map_url'] ?? '' }}</textarea>
            <small style="color: #666;">Paste the full &lt;iframe&gt; code from Google Maps here.</small>
        </div>

        <button type="submit" class="btn" style="margin-top: 20px; padding: 12px 30px; font-size: 1.1rem;">Save Contact Info</button>
    </form>
</div>
@endsection

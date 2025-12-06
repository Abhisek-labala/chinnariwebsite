@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Theme Settings</h2>
</div>

<div class="admin-card">
    <form action="{{ route('admin.settings.updateTheme') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="display: flex; gap: 40px; flex-wrap: wrap;">
            <!-- Logo Settings -->
            <div style="flex: 1; min-width: 300px;">
                <h3 style="margin-bottom: 20px; color: var(--primary);">Brand Identity</h3>
                
                <div class="form-group">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block;">Site Name</label>
                    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Chinnari Medicos' }}" class="form-control" placeholder="e.g. My Clinic">
                    
                    <div style="margin-top: 10px; display: flex; align-items: center; gap: 20px;">
                        <label style="display: flex; align-items: center; cursor: pointer;">
                            <input type="checkbox" name="show_site_name" value="1" {{ isset($settings['show_site_name']) && $settings['show_site_name'] == '1' ? 'checked' : '' }} style="margin-right: 8px;">
                            Show Name with Logo
                        </label>
                        
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <label style="font-size: 0.9rem;">Text Color:</label>
                            <input type="color" name="site_name_color" value="{{ $settings['site_name_color'] ?? '#333333' }}" style="height: 30px; width: 40px; border: none; padding: 0;">
                        </div>
                    </div>
                    
                    <p style="font-size: 0.85rem; color: #777; margin-top: 5px;">Displayed if no logo is uploaded, or if checkbox is checked.</p>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label style="font-weight: 600; margin-bottom: 10px; display: block;">Current Logo</label>
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                        <div style="background: #f1f2f6; padding: 20px; border-radius: 10px; display: inline-block;">
                            @if(isset($settings['site_logo']))
                                <img src="{{ asset($settings['site_logo']) }}" alt="Site Logo" style="max-height: 50px;">
                            @else
                                <span style="color: #999;">No custom logo uploaded</span>
                            @endif
                        </div>
                        @if(isset($settings['site_logo']))
                            <button type="button" onclick="if(confirm('Remove logo?')){ document.getElementById('remove-logo-form').submit(); }" class="btn" style="background: #ff7675; padding: 10px 15px;" title="Remove Logo">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                    </div>
                    
                    <label style="font-weight: 600; margin-bottom: 10px; display: block;">Upload New Logo</label>
                    <input type="file" name="site_logo" class="form-control" accept="image/*">
                    <p style="font-size: 0.85rem; color: #777; margin-top: 5px;">Recommended height: 50px. Transparent PNG.</p>

                    <div style="margin-top: 20px;">
                        <label style="font-weight: 600; margin-bottom: 10px; display: block;">
                            Logo Size (Height): <span id="logo-size-display">{{ $settings['site_logo_height'] ?? 40 }}</span>px
                        </label>
                        <input type="range" name="site_logo_height" min="20" max="150" value="{{ $settings['site_logo_height'] ?? 40 }}" 
                               oninput="document.getElementById('logo-size-display').innerText = this.value" style="width: 100%;">
                    </div>
                </div>
            </div>

            <!-- Color Settings -->
            <div style="flex: 1; min-width: 300px;">
                <h3 style="margin-bottom: 20px; color: var(--primary);">Color Scheme</h3>
                
                <div class="form-group">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block;">Primary Color</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="color" name="theme_primary" value="{{ $settings['theme_primary'] ?? '#007bff' }}" style="height: 40px; width: 60px; padding: 0; border: none; cursor: pointer;">
                        <input type="text" name="theme_primary" value="{{ $settings['theme_primary'] ?? '#007bff' }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block;">Secondary Color</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="color" name="theme_secondary" value="{{ $settings['theme_secondary'] ?? '#00d2d3' }}" style="height: 40px; width: 60px; padding: 0; border: none; cursor: pointer;">
                        <input type="text" name="theme_secondary" value="{{ $settings['theme_secondary'] ?? '#00d2d3' }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block;">Accent Color</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input type="color" name="theme_accent" value="{{ $settings['theme_accent'] ?? '#ff9f43' }}" style="height: 40px; width: 60px; padding: 0; border: none; cursor: pointer;">
                        <input type="text" name="theme_accent" value="{{ $settings['theme_accent'] ?? '#ff9f43' }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 30px; text-align: right;">
            <button type="submit" class="btn" style="padding: 12px 30px;">Save Configuration</button>
        </div>
    </form>
</div>
</div>

<form id="remove-logo-form" action="{{ route('admin.settings.removeLogo') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

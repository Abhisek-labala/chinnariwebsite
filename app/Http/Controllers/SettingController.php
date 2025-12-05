<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        // Fetch specific about page settings
        $settings = Setting::whereIn('key', ['about_title', 'about_description', 'about_image'])->pluck('value', 'key');
        
        return view('admin.settings.about', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_title' => 'required|string|max:255',
            'about_description' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update Title
        Setting::updateOrCreate(['key' => 'about_title'], ['value' => $request->about_title]);

        // Update Description
        Setting::updateOrCreate(['key' => 'about_description'], ['value' => $request->about_description]);

        // Update Image
        if ($request->hasFile('about_image')) {
            $imageName = 'about-us-' . time() . '.' . $request->about_image->extension();
            $request->about_image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;

            Setting::updateOrCreate(['key' => 'about_image'], ['value' => $imagePath]);
        }

        return redirect()->route('admin.settings.about')->with('success', 'About page content updated successfully.');
    }
    public function contact()
    {
        $settings = Setting::whereIn('key', ['contact_address', 'contact_phone', 'contact_email', 'contact_timings_morning', 'contact_timings_evening', 'contact_map_url'])->pluck('value', 'key');
        return view('admin.settings.contact', compact('settings'));
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'contact_address' => 'required|string',
            'contact_phone' => 'required|string',
            'contact_email' => 'required|email',
            'contact_timings_morning' => 'required|string',
            'contact_timings_evening' => 'required|string',
            'contact_map_url' => 'nullable|string',
        ]);

        Setting::updateOrCreate(['key' => 'contact_address'], ['value' => $request->contact_address]);
        Setting::updateOrCreate(['key' => 'contact_phone'], ['value' => $request->contact_phone]);
        Setting::updateOrCreate(['key' => 'contact_email'], ['value' => $request->contact_email]);
        Setting::updateOrCreate(['key' => 'contact_timings_morning'], ['value' => $request->contact_timings_morning]);
        Setting::updateOrCreate(['key' => 'contact_timings_evening'], ['value' => $request->contact_timings_evening]);
        Setting::updateOrCreate(['key' => 'contact_map_url'], ['value' => $request->contact_map_url]);

        return redirect()->route('admin.settings.contact')->with('success', 'Contact details updated successfully.');
    }
}

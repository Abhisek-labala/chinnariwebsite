<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $doctors = Doctor::orderBy('id', 'desc')->get(); // Fetch all for slider
        $testimonials = Testimonial::where('is_approved', true)->latest()->take(5)->get();
        $services = Service::take(3)->get();
        return view('home', compact('doctors', 'testimonials', 'services'));
    }

    public function about()
    {
        $settings = Setting::whereIn('key', ['about_title', 'about_description', 'about_image'])->pluck('value', 'key');
        return view('about', compact('settings'));
    }

    public function services()
    {
        $services = Service::all();
        return view('services', compact('services'));
    }

    public function doctors()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function contact()
    {
        $settings = Setting::whereIn('key', ['contact_address', 'contact_phone', 'contact_email', 'contact_timings_morning', 'contact_timings_evening', 'contact_map_url'])->pluck('value', 'key');
        return view('contact', compact('settings'));
    }

    public function gallery()
    {
        $images = Gallery::latest()->get();
        return view('gallery', compact('images'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('is_approved', true)->get();
        return view('testimonials.index', compact('testimonials'));
    }
}

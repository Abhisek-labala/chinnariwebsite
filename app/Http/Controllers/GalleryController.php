<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::latest()->get();
        return view('admin.gallery.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/gallery'), $imageName);
            $imagePath = 'images/gallery/' . $imageName;

            Gallery::create([
                'title' => $request->title,
                'image_path' => $imagePath,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Image uploaded successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete file from public
        if (file_exists(public_path($gallery->image_path))) {
            unlink(public_path($gallery->image_path));
        }

        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted successfully.');
    }
}

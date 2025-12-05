<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'specialist' => 'required',
            'date' => 'nullable|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('doctors', 'public');
            $data['image_path'] = $path;
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor added successfully.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'specialist' => 'required',
            'date' => 'nullable|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($doctor->image_path) {
                Storage::disk('public')->delete($doctor->image_path);
            }
            $path = $request->file('image')->store('doctors', 'public');
            $data['image_path'] = $path;
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->image_path) {
            Storage::disk('public')->delete($doctor->image_path);
        }
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}

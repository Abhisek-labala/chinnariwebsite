<?php

namespace App\Http\Controllers;

use App\Models\MedicineRequest;
use Illuminate\Http\Request;

class MedicineRequestController extends Controller
{
    public function create()
    {
        return view('medicine_requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'medicines' => 'nullable|string', // JSON string from frontend (nullable because prescription is main)
            'prescription' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $prescriptionPath = null;
        if ($request->hasFile('prescription')) {
            $imageName = 'prescription-' . time() . '.' . $request->prescription->extension();
            $request->prescription->move(public_path('prescriptions'), $imageName);
            $prescriptionPath = 'prescriptions/' . $imageName;
        }

        MedicineRequest::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'medicines' => $validated['medicines'],
            'prescription_path' => $prescriptionPath,
        ]);

        return redirect()->back()->with('success', 'Your medicine request has been submitted successfully!');
    }

    public function index()
    {
        $requests = MedicineRequest::latest()->get();
        return view('admin.medicine_requests.index', compact('requests'));
    }

    public function destroy(MedicineRequest $medicineRequest)
    {
        if ($medicineRequest->prescription_path && file_exists(public_path($medicineRequest->prescription_path))) {
            unlink(public_path($medicineRequest->prescription_path));
        }
        $medicineRequest->delete();
        return redirect()->back()->with('success', 'Request deleted successfully.');
    }
}

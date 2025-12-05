<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    // Public: Show Booking Form
    public function create(Doctor $doctor)
    {
        return view('appointments.create', compact('doctor'));
    }

    // Public: Store Booking
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'problem' => 'required|string',
            'appointment_date' => 'required|date',
        ]);

        Appointment::create($request->all());

        return redirect()->route('doctors.index')->with('success', 'Appointment booked successfully! We will contact you shortly.');
    }

    // Admin: List Appointments with Filters
    public function index(Request $request)
    {
        $query = Appointment::with('doctor');

        // Filter by Doctor
        if ($request->has('doctor_id') && $request->doctor_id != '') {
            $query->where('doctor_id', $request->doctor_id);
        }

        // Filter by Date
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('appointment_date', $request->date);
        }

        // Filter by Month
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('appointment_date', \Carbon\Carbon::parse($request->month)->month)
                  ->whereYear('appointment_date', \Carbon\Carbon::parse($request->month)->year);
        }

        $appointments = $query->latest()->get();
        $doctors = Doctor::all();

        return view('admin.appointments.index', compact('appointments', 'doctors'));
    }

    // Admin: Create Form
    public function createAdmin()
    {
        $doctors = Doctor::all();
        return view('admin.appointments.create', compact('doctors'));
    }

    // Admin: Store Appointment
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'problem' => 'required|string',
            'appointment_date' => 'required|date',
            'status' => 'required|string',
        ]);

        Appointment::create($request->all());

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment created successfully.');
    }

    // Admin: Edit Form
    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::all();
        return view('admin.appointments.edit', compact('appointment', 'doctors'));
    }

    // Admin: Update Appointment
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_name' => 'required|string|max:255',
            'patient_phone' => 'required|string|max:20',
            'problem' => 'required|string',
            'appointment_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $appointment->update($request->all());

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully.');
    }

    // Admin: Update Status
    public function updateStatus(Appointment $appointment, $status)
    {
        $appointment->update(['status' => $status]);
        return redirect()->back()->with('success', 'Appointment status updated to ' . ucfirst($status));
    }

    // Admin: Delete Appointment
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}

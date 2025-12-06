<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactController;

// Public Routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials.index');

// Public Testimonial Submission
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

// Public Appointment Booking
Route::get('/appointments/book/{doctor}', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes - Protected
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Doctors CRUD
    Route::resource('doctors', DoctorController::class);

    // Testimonials Management
    Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::patch('testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Appointments Management
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('appointments/create', [AppointmentController::class, 'createAdmin'])->name('appointments.create');
    Route::post('appointments', [AppointmentController::class, 'storeAdmin'])->name('appointments.store');
    Route::get('appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::patch('appointments/{appointment}/status/{status}', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
    Route::delete('appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    // Services Management
    Route::resource('services', ServiceController::class);

    // Gallery Management
    Route::resource('gallery', GalleryController::class)->only(['index', 'store', 'destroy']);

    // Contact Messages
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Settings (About Page)
    Route::get('settings/about', [SettingController::class, 'index'])->name('settings.about');
    Route::post('settings/about', [SettingController::class, 'update'])->name('settings.update');

    Route::get('settings/contact', [SettingController::class, 'contact'])->name('settings.contact');
    Route::post('settings/contact', [SettingController::class, 'updateContact'])->name('settings.updateContact');

    Route::get('settings/theme', [SettingController::class, 'theme'])->name('settings.theme');
    Route::post('settings/theme', [SettingController::class, 'updateTheme'])->name('settings.updateTheme');
    Route::delete('settings/theme/logo', [SettingController::class, 'removeLogo'])->name('settings.removeLogo');
});

// Contact Form Submission (Public)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Medicine Request Routes
Route::get('/request-medicine', [App\Http\Controllers\MedicineRequestController::class, 'create'])->name('medicine_requests.create');
Route::post('/request-medicine', [App\Http\Controllers\MedicineRequestController::class, 'store'])->name('medicine_requests.store');

// Admin Medicine Requests
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('medicine-requests', [App\Http\Controllers\MedicineRequestController::class, 'index'])->name('medicine_requests.index');
    Route::delete('medicine-requests/{medicineRequest}', [App\Http\Controllers\MedicineRequestController::class, 'destroy'])->name('medicine_requests.destroy');
});

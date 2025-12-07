<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberBookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPcController;
use App\Http\Controllers\Admin\AdminArenaController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminUserController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route bawaan profile breeze bisa dibiarkan atau dihapus nanti karena kita akan buat sendiri di dashboard
Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/booking/create', [MemberBookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [MemberBookingController::class, 'store'])->name('booking.store');

    Route::get('/payment/{booking}', [PaymentController::class, 'show'])->name('payment.show');
    Route::put('/payment/{booking}', [PaymentController::class, 'update'])->name('payment.update');
});

// --- PUBLIC ROUTES (Level 1) ---
Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/arenas', 'arenas')->name('public.arenas');
    Route::get('/competitions', 'competitions')->name('public.competitions');
    Route::get('/schedule', 'schedule')->name('public.schedule');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk melihat Tiket / Invoice
    Route::get('/booking/{booking}', [MemberBookingController::class, 'show'])->name('booking.show');
});

// --- BACKEND ROUTES (Admin & Staff) ---
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Utama (Admin & Staff) - Controller akan membedakan view-nya
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->middleware('role:admin,staff_pc,staff_arena') // <--- IZINKAN STAFF
        ->name('dashboard');

    // Calendar Route (Akses: Admin & Semua Staff)
    Route::get('/calendar', [\App\Http\Controllers\Admin\AdminCalendarController::class, 'index'])
        ->middleware('role:admin,staff_pc,staff_arena')
        ->name('calendar.index');

    // 2. Manage PCs (Admin & Staff PC)
    Route::resource('pcs', AdminPcController::class)
        ->middleware('role:admin,staff_pc');

    // 3. Manage Arenas (Admin & Staff Arena)
    Route::resource('arenas', AdminArenaController::class)
        ->middleware('role:admin,staff_arena');

    // 4. Manage Bookings (Semua Staff butuh akses untuk cek status, tapi Admin supervisor)
    // Atau bisa dibatasi: Staff PC cuma bisa cek booking PC (Logika kompleks, untuk sekarang buka dulu)
    Route::resource('bookings', AdminBookingController::class)
        ->middleware('role:admin,staff_pc,staff_arena')
        ->only(['index', 'update']);

    // 5. Manage Users (Hanya Admin)
    Route::resource('users', AdminUserController::class)
        ->middleware('role:admin');
});
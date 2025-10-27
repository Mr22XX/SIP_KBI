<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KeuanganController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ROUTE MAIN
Route::get('/', function () {
    return view('main.welcome');
});

// ROUTE DASHBOARD (otomatis ke dashboard sesuai role)
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    // Arahkan ke dashboard sesuai role
    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('karyawan.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ROUTE DASHBOARD KARYAWAN / USER
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [KeuanganController::class, 'index'])->name('karyawan.dashboard');
    Route::get('/keuangan', fn() => view('dashboardKaryawan.keuangan'))->name('karyawan.keuangan');
    Route::get('/budidaya', fn() => view('dashboardKaryawan.budidaya'))->name('karyawan.budidaya');
});

// ROUTE DASHBOARD ADMIN / PEMILIK
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('dashboardPemilik.dashboard'))->name('admin.dashboard');
});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// LOGIN & REGISTER
require __DIR__.'/auth.php';

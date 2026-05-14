<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\MediaController;

// =====================
// Frontend Routes
// =====================
Route::get('/', [HomeController::class, 'index'])->name('home');

// =====================
// Admin Routes (protected)
// =====================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Hero
    Route::resource('hero', HeroController::class)->only(['index', 'edit', 'update']);

    // Services
    Route::resource('services', ServicesController::class);
    Route::post('services/reorder', [ServicesController::class, 'reorder'])->name('services.reorder');

    // Projects (Case Studies)
    Route::resource('projects', ProjectsController::class);
    Route::post('projects/reorder', [ProjectsController::class, 'reorder'])->name('projects.reorder');

    // Testimonials
    Route::resource('testimonials', TestimonialsController::class);

    // Pricing
    Route::resource('pricing', PricingController::class);

    // Clients (Logo Swiper)
    Route::resource('clients', ClientsController::class);
    Route::post('clients/reorder', [ClientsController::class, 'reorder'])->name('clients.reorder');

    // Site Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Media Upload
    Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

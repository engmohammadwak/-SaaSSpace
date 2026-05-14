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

// ─── Frontend ───────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ─── Admin ──────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Hero
    Route::get('hero',           [HeroController::class, 'index'])->name('hero.index');
    Route::put('hero',           [HeroController::class, 'update'])->name('hero.update');

    // Services
    Route::resource('services',     ServicesController::class);

    // Projects (Case Studies)
    Route::resource('projects',     ProjectsController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialsController::class);

    // Pricing
    Route::resource('pricing',      PricingController::class);

    // Clients (Logos)
    Route::resource('clients',      ClientsController::class);

    // Settings
    Route::get('settings',  [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings',  [SettingsController::class, 'update'])->name('settings.update');

    // Media
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::delete('media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
});

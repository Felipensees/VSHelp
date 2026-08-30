<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FirstLoginPasswordController;
use App\Http\Controllers\TotemInspectionController;
use App\Http\Controllers\OccurrenceController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

    Route::get(
        '/change-password',
        [FirstLoginPasswordController::class, 'edit']
    )->name('password.first.edit');

    Route::put(
        '/change-password',
        [FirstLoginPasswordController::class, 'update']
    )->name('password.first.update');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware([
    'auth',
    'verified',
    'password.changed',
])->name('dashboard');

Route::middleware(['auth', 'password.changed'])->group(function () {
    Route::resource('/occurrences', OccurrenceController::class);
});

Route::patch(
    '/occurrences/{occurrence}/start',
    [OccurrenceController::class, 'start']
)->name('occurrences.start');

Route::patch(
    '/occurrences/{occurrence}/resolve',
    [OccurrenceController::class, 'resolve']
)->name('occurrences.resolve');

Route::patch(
    '/occurrences/{occurrence}/close',
    [OccurrenceController::class, 'close']
)->name('occurrences.close');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'password.changed', 'superadmin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('/admin/sectors', SectorController::class)
        ->except(['show']);

    Route::resource('/admin/users', UserController::class)
        ->except(['show']);
});

Route::middleware(['auth', 'password.changed'])->group(function () {
    Route::get('/totens', [TotemInspectionController::class, 'index'])
        ->name('totem-inspections.index');

    Route::get('/totens/novo', [TotemInspectionController::class, 'create'])
        ->name('totem-inspections.create');

    Route::post('/totens', [TotemInspectionController::class, 'store'])
        ->name('totem-inspections.store');

    Route::get('/totens/{totemInspection}', [TotemInspectionController::class, 'show'])
        ->name('totem-inspections.show');
    
    Route::put(
    '/totens/{totemInspection}',
    [TotemInspectionController::class, 'update']
    )->name('totem-inspections.update');

    Route::patch(
    '/totens/{totemInspection}/finalizar',
    [TotemInspectionController::class, 'finalize']
    )->name('totem-inspections.finalize');
});
require __DIR__.'/auth.php';

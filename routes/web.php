<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'index'])
    ->name('search')
    ->middleware('auth');

Route::get(
    '/activities/export/excel',
    [ActivityController::class, 'exportExcel']
)->name('activities.export.excel');

Route::get('/admin-test', function () {
    return 'Welcome Administrator!';
})->middleware('role:admin');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');
    Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])
    ->name('comments.store');
    Route::resource('tickets', TicketController::class);
    Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);

    Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/activities', [ActivityController::class, 'index'])
        ->name('activities.index');

});

});
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

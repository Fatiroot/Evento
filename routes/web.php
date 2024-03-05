<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('/users',UserController::class);
Route::resource('/categories',CategoryController::class);
Route::resource('/events',EventController::class);
Route::get('/eventsorganizater',[EventController::class,'allevents'])->name('allevents');
Route::put('events/{event}/update-status-published', [EventController::class,'updateStatusPublished'])->name('events.updateStatusPublished');
Route::put('events/{event}/update-automatic-acceptance', [EventController::class,'updateAutomaticAcceptance'])->name('events.updateAutomaticAcceptance');
Route::put('events/{event}/update-status', [EventController::class,'updateStatus'])->name('events.updateStatus');













Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboardorganizer', function () {
    return view('organizer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboardorganizer');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

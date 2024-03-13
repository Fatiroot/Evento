<?php

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventUserController;
use App\Http\Controllers\TicketPdfController;
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
//Admin
Route::middleware( 'role:admin')->group(function () {
Route::resource('/users',UserController::class);
Route::get('/dashboard',[UserController::class,'adminStatistic'])->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('/categories',CategoryController::class);
Route::get('/allevents',[EventController::class,'allevents'])->name('allevents');
Route::put('events/{event}/update-status', [EventController::class,'updateStatus'])->name('events.updateStatus');

});

//Organizer
Route::middleware( 'role:organizer')->group(function () {
Route::resource('/events',EventController::class);
Route::put('events/{event}/update-status-published', [EventController::class,'updateStatusPublished'])->name('events.updateStatusPublished');
Route::put('events/{event}/update-automatic-acceptance', [EventController::class,'updateAutomaticAcceptance'])->name('events.updateAutomaticAcceptance');
Route::get('/dashboardorganizer',[EventUserController::class,'organizerStatistic'])->middleware(['auth', 'verified'])->name('dashboardorganizer');
Route::put('reservations/{eventuser}/update-status', [EventUserController::class,'updateStatus'])->name('eventuser.updateStatus');
Route::resource('reservations', EventUserController::class);

});

//Home
Route::get('/home',[EventController::class,'eventshome'])->name('eventshome');
Route::get('/event/{id}', [EventController::class, 'showevent'])->name('event.show');
Route::post('reservation', [EventUserController::class, 'reservation'])->name('reservation');

Route::get('generate-ticket/{event}', [TicketPdfController::class, 'generateTicket'])->name('ticket');
Route::get('/search', [EventController::class, 'search'])->name('events.search');
















Route::get('/', function () {
    return view('welcome');
});


// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboardorganizer', function () {
//     return view('organizer.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboardorganizer');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

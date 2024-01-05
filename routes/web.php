<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketOnsiteController;

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
 
Route::get('/', function () {return redirect('/login');});
Route::get('/login', function () {return view('guest.login');})->middleware('guest');
Route::get('/register', function () {return view('guest.register');})->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest')->name('login');
Route::get('/dashboard', [LoginController::class, 'dashboard'])->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::post('/konsultasi/{user}', [ConnectController::class, 'index'])->middleware('auth');
Route::get('/chat/{connect}', [ConnectController::class, 'showChat'])->middleware('auth');
Route::post('/chat/{connect}', [MessageController::class, 'store'])->middleware('auth');
Route::get('/list-dokter', [LoginController::class, 'dashboard'])->middleware('auth');
Route::get('/tiket-onsite/list', [TicketOnsiteController::class, 'index'])->middleware('auth');
Route::delete('/tiket-onsite/{ticketOnsite}', [TicketOnsiteController::class, 'destroy'])->middleware('auth');
Route::put('/tiket-onsite/{ticketOnsite}', [TicketOnsiteController::class, 'update'])->middleware('auth');
Route::post('/tiket-onsite', [TicketOnsiteController::class, 'store'])->middleware('auth');
Route::post('/register', [LoginController::class, 'register'])->middleware('guest');
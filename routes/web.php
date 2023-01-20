<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('client.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\RegistrationController::class, 'show'])->name('dashboard');
    Route::get('/dashboardFiltered', [App\Http\Controllers\RegistrationController::class, 'filter'])->name('filter');
});

//client registration

Route::get('form/{origin}', [App\Http\Controllers\RegistrationController::class, 'index'])->name('registration');
Route::post('store/{origin}', [App\Http\Controllers\RegistrationController::class, 'store'])->name('registration.store');

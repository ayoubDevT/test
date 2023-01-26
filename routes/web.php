<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\RegistrationController;
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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [RegistrationController::class, 'show'])->name('dashboard');
    Route::resource('import', ImportController::class);
    /*Route::get('import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/importing', [ImportController::class, 'store'])->name('import.store');*/
});

//client registration
/*Route::get('/', [RegistrationController::class, 'index'])->name('index');
Route::resource('registration', RegistrationController::class);*/

<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FileUploadController;
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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ FileUploadController::class, 'store' ])->name('profile.fileupload');

    Route::get('/company', [CompanyController::class, 'create'])->name('company');
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/company/{id}', [CompanyController::class, 'show'])->name('company-detail');
    Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('profile.company-edit');
    Route::post('/company/edit/{id}', [CompanyController::class, 'update'])->name('company.update');

    Route::get('/add-booking', [BookingController::class, 'create'])->name('profile.add-booking');


    Route::get('/dashboard', [CompanyController::class, 'getCompany'])->name('dashboard');

});

require __DIR__.'/auth.php';

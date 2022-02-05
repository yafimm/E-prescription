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

Auth::routes();


Route::group(['middleware' => ['web', 'auth']], function() {
  Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  // Medicine Module
  Route::group(['prefix' => 'medicine'], function() {
      Route::get('/load-data', [App\Http\Controllers\MedicineController::class, 'loadData'])->name('medicine.load-data');
      Route::get('/get-data', [App\Http\Controllers\MedicineController::class, 'getMedicine'])->name('medicine.get-data');
  });
  Route::resource('medicine', App\Http\Controllers\MedicineController::class)->only([
    'index',
  ]);


  // Signa Module
  Route::group(['prefix' => 'signa'], function() {
      Route::get('/load-data', [App\Http\Controllers\SignaController::class, 'loadData'])->name('signa.load-data');
  });
  Route::resource('signa', App\Http\Controllers\SignaController::class)->only([
      'index',
  ]);

  // Prescription Module
  Route::resource('prescription', App\Http\Controllers\PrescriptionController::class);

});

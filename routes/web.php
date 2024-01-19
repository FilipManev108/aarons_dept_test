<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\EmployeeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::redirect('/', '/home');

Route::get('/home', [UserController::class, 'index'])->name('employees.index');
Route::get('/user/{user}', [UserController::class, 'show'])->name('employees.show');

Route::get('/shift', [ShiftController::class, 'index'])->name('shifts.index');
Route::get('/shift/create', [ShiftController::class, 'create'])->name('shifts.create');
Route::post('/shift/store', [ShiftController::class, 'store'])->name('shifts.store');
Route::get('/shift/edit/{shift}', [ShiftController::class, 'edit'])->name('shifts.edit');
Route::patch('/shift/{shift}', [ShiftController::class, 'update'])->name('shifts.update');
Route::delete('/shift/{shift}', [ShiftController::class, 'destroy'])->name('shifts.destroy');

Route::get('/upload', [CSVController::class, 'create'])->name('uploads.csv');
Route::post('/upload', [CSVController::class, 'store'])->name('uploads.csv');
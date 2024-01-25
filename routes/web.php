<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReligionController;
use App\Models\Employee;

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
    $jumlahpegawai = Employee::count();
    $jumlahpegawai_cowo = Employee::where('jeniskelamin', 'cowo')->count();
    $jumlahpegawai_cewe = Employee::where('jeniskelamin', 'cewe')->count();

    return view('welcome', compact('jumlahpegawai', 'jumlahpegawai_cowo', 'jumlahpegawai_cewe'));
})->middleware('auth');


Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai')->middleware('auth');
//insert data
Route::get('/tambahpegawai', [EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai')->middleware('auth');
Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata')->middleware('auth');
//edit data
Route::get('/tampilkandata/{id}', [EmployeeController::class, 'tampilkandata'])->name('tampilkandata')->middleware('auth');
Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata')->middleware('auth');
//delete data
Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete')->middleware('auth');
//export pdf
Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf')->middleware('auth');
// Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');

//login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');
//register
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');
//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//data religion
Route::get('/datareligion', [ReligionController::class, 'index'])->name('datareligion')->middleware('auth');
Route::get('/tambahagama', [ReligionController::class, 'create'])->name('tambahagama')->middleware('auth');

Route::post('/insertdatareligion', [ReligionController::class, 'store'])->name('insertdatareligion')->middleware('auth');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManpowerController;
use App\Manpower;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\AreakerjaController;
use App\Http\Controllers\DepartemenController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;


Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/Pegawai/{id}', [ManpowerController::class, 'showGuest'])->name('manpower.showguest');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/manpower', [ManpowerController::class, 'index'])->name('manpower.index');
    Route::get('/manpower/create', [ManpowerController::class, 'create'])->name('manpower.create');
    Route::post('/manpower/store', [ManpowerController::class, 'store'])->name('manpower.store');
    Route::get('manpower/{id}/edit', [ManpowerController::class, 'edit'])->name('manpower.edit');
    Route::put('manpower/update/{id}', [ManpowerController::class, 'update'])->name('manpower.update');
    Route::get('manpower/{id}', [ManpowerController::class, 'show'])->name('manpower.show');
    Route::delete('/manpower/delete/{id}', [ManpowerController::class, 'destroy'])->name('manpower.destroy');
    Route::get('kirimemail/{id}', [ManpowerController::class, 'sendEmail'])->name('kirimemail.web');
    Route::get('printAllQRCodes', [ManpowerController::class, 'printAllQRCodes'])->name('manpower.printAllQRCodes');
    Route::get('printByAreaKerja', [ManpowerController::class, 'printByAreaKerja'])->name('manpower.printByAreaKerja');



    Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::get('jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
    Route::post('jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
    Route::get('jabatan/{id}', [JabatanController::class, 'show'])->name('jabatan.show');
    Route::get('jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::put('jabatan/{id}/update', [JabatanController::class, 'update'])->name('jabatan.update');
    Route::delete('jabatan/{id}/destroy', [JabatanController::class, 'destroy'])->name('jabatan.destroy');

    Route::get('areakerja', [AreakerjaController::class, 'index'])->name('areakerja.index');
    Route::get('areakerja/create', [AreakerjaController::class, 'create'])->name('areakerja.create');
    Route::post('areakerja/store', [AreakerjaController::class, 'store'])->name('areakerja.store');
    Route::get('areakerja/{id}', [AreakerjaController::class, 'show'])->name('areakerja.show');
    Route::get('areakerja/{id}/edit', [AreakerjaController::class, 'edit'])->name('areakerja.edit');
    Route::put('areakerja/{id}/update', [AreakerjaController::class, 'update'])->name('areakerja.update');
    Route::delete('areakerja/{id}/destroy', [AreakerjaController::class, 'destroy'])->name('areakerja.destroy');

    Route::get('departemen', [DepartemenController::class, 'index'])->name('departemen.index');
    Route::get('departemen/create', [DepartemenController::class, 'create'])->name('departemen.create');
    Route::post('departemen/store', [DepartemenController::class, 'store'])->name('departemen.store');
    Route::get('departemen/{id}', [DepartemenController::class, 'show'])->name('departemen.show');
    Route::get('departemen/{id}/edit', [DepartemenController::class, 'edit'])->name('departemen.edit');
    Route::put('departemen/{id}/update', [DepartemenController::class, 'update'])->name('departemen.update');
    Route::delete('departemen/{id}/destroy', [DepartemenController::class, 'destroy'])->name('departemen.destroy');




    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

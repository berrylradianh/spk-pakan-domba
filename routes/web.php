<?php

use App\Http\Controllers\BobotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenilaianUserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
});

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria');
Route::post('/kriteria/store', [KriteriaController::class, 'store'])->name('kriteria.store');
Route::post('/kriteria/destroy', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

Route::get('/bobot', [BobotController::class, 'index'])->name('bobot');
Route::post('/bobot/store', [BobotController::class, 'store'])->name('bobot.store');
Route::post('/bobot/destroy', [BobotController::class, 'destroy'])->name('bobot.destroy');

Route::get('/pakan', [PakanController::class, 'index'])->name('pakan');
Route::post('/pakan/store', [PakanController::class, 'store'])->name('pakan.store');
Route::post('/pakan/destroy', [PakanController::class, 'destroy'])->name('pakan.destroy');


Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian');
Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
Route::delete('/penilaian/destroy', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/penilaian/user', [PenilaianController::class, 'user'])->name('user');
    Route::post('/penilaian/generate-ranking', [PenilaianController::class, 'generateRanking'])->name('generateRanking');

    Route::get('/penilaian/user/manual', [PenilaianUserController::class, 'index'])->name('penilaian.user');
    Route::post('/penilaian/user/store', [PenilaianUserController::class, 'store'])->name('penilaian.user.store');
    Route::post('/penilaian/user/destroy', [PenilaianUserController::class, 'destroy'])->name('penilaian.user.destroy');
    Route::get('/penilaian/user/user', [PenilaianUserController::class, 'user'])->name('user.user');
    Route::post('/penilaian/user/generate-ranking', [PenilaianUserController::class, 'generateRanking'])->name('generateRanking.user');
});

Route::post('/login', [DashboardController::class, 'login'])->name('process.login');

Route::post('/logout', [DashboardController::class, 'logout'])->name('process.logout');

Route::get('/kriteria/edit/{id}', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::post('/kriteria/update/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');

Route::get('/bobot/edit/{id}', [BobotController::class, 'edit'])->name('bobot.edit');
Route::post('/bobot/update/{id}', [BobotController::class, 'update'])->name('bobot.update');

Route::get('/pakan/edit/{id}', [PakanController::class, 'edit'])->name('pakan.edit');
Route::post('/pakan/update/{id}', [PakanController::class, 'update'])->name('pakan.update');

Route::get('/penilaian/edit/{id}', [PenilaianController::class, 'edit'])->name('penilaian.edit');
Route::post('/penilaian/update/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');

Route::post('/penilaian/user/update/{id}', [PenilaianUserController::class, 'update'])->name('penilaian.user.update');

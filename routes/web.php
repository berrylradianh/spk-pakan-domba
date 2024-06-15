<?php

use App\Http\Controllers\BobotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\PenilaianController;
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
Route::post('/penilaian/destroy', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

Route::get('/penilaian/user', [PenilaianController::class, 'user'])->name('user');
Route::post('/penilaian/generate-ranking', [PenilaianController::class, 'generateRanking'])->name('generateRanking');


Route::post('/login', [DashboardController::class, 'login'])->name('process.login');

Route::post('/logout', [DashboardController::class, 'logout'])->name('process.logout');

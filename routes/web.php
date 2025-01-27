<?php

use App\Http\Controllers\StudentProfileController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/', [HomeController::class, 'Index'])->name('home');
Route::get('/Home/Create', [HomeController::class, 'HomeCreate'])->name('home.create');
Route::post('/Home/Store', [HomeController::class, 'homeStore'])->name('home.store');
Route::get('/Home/{home}/Edit', [HomeController::class, 'homeEdit'])->name('home.edit');
Route::put('/Home/Update/{home}', [HomeController::class, 'homeUpdate'])->name('home.update');
Route::delete('/Home/delete/{home}', [HomeController::class, 'homeDelete'])->name('home.delete');


Route::get('/', [StudentProfileController::class, 'Index'])->name('studentprofiles');
Route::get('/StudentProfile/Create', [StudentProfileController::class, 'StudentProfileCreate'])->name('studentprofile.create');
Route::post('/StudentProfile/Store', [StudentProfileController::class, 'StudentProfileStore'])->name('studentprofile.store');
Route::get('/StudentProfile/{studentprofile}/Edit', [StudentProfileController::class, 'StudentProfileEdit'])->name('studentprofile.edit');
Route::put('/StudentProfile/Update/{studentprofile}', [StudentProfileController::class, 'StudentProfileUpdate'])->name('studentprofile.update');
Route::delete('/StudentProfile/delete/{studentprofile}', [StudentProfileController::class, 'StudentProfileDelete'])->name('studentprofile.delete');







Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

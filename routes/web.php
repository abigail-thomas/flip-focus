<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudySetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;


use App\Models\StudySet;

Route::get('/', function () {
    $sets = StudySet::orderBy('title')->take(5)->get();
    return view('index', ['sets' => $sets]);
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/study/create', [StudySetController::class, 'create'])->name('study.create');
    Route::post('/study', [StudySetController::class, 'store'])->name('study.store');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::post('/study/{set}/saveSet', [StudySetController::class, 'saveSet'])->name('study.saveSet');
});

Route::get('/study/browse', [StudySetController::class, 'browse'])->name('study.browse');
Route::get('/study/search', [StudySetController::class, 'search'])->name('search');
Route::get('/study/edit/{set}', [StudySetController::class, 'edit'])->name('edit');
Route::put('/study/update', [StudySetController::class, 'update'])->name('update');
Route::get('/study/{studySet}', [StudySetController::class, 'show'])->name('study.show');
// incrementing thre number of studies
Route::post('/study/{studySet}/increment', [StudySetController::class, 'incrementNumStudies'])->name('study.increment');
Route::delete('/study/{studySet}', [StudySetController::class, 'destroy'])->name('set.destroy');




// Auth stuff
Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleWare('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

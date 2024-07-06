<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\ProfileController;
use App\Models\Athlete;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/athlete_landing', [AthleteController::class, 'index']);

Route::get('/coach_landing', [CoachController::class, 'index']);

Route::get('/guardian_landing', [GuardianController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/updateAthletePersonal/{id}', [\App\Http\Controllers\AthleteController::class, 'updateAthleteDetails'])->name('athlete.updatePersonal');
Route::post('/updateAthleteDetails', [\App\Http\Controllers\AthleteController::class, 'updateAthleteCoach'])->name('coach.updateAthlete');
Route::get('/getAthleteData/{id}', [\App\Http\Controllers\AthleteController::class, 'fetchAthleteData']);

require __DIR__.'/auth.php';

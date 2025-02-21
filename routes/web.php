<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



require __DIR__.'/auth.php';
Route::get('/', [QuestionController::class, 'index'])->name('home');
Route::get('/search', [QuestionController::class, 'search'])->name('questions.search');
Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
Route::get('/popular', [QuestionController::class, 'popular'])->name('questions.popular');
    Route::get('/recent', [QuestionController::class, 'recent'])->name('questions.recent');
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/question', [DashboardController::class, 'storeQuestion'])->name('dashboard.storeQuestion');
    Route::post('/dashboard/answer/{question}', [DashboardController::class, 'storeAnswer'])->name('dashboard.storeAnswer');

    // Questions
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create')->middleware('auth');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store')->middleware('auth');
   
    //Route::get('/search', [QuestionController::class, 'search'])->name('questions.search');
    
    // Réponses
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');

    // Favoris
   
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/questions/{question}/favorite', [FavoriteController::class, 'toggle'])->name('questions.favorite');;
    // Profil
   // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
   // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    
    // Autres routes pour le profil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/favorites', [ProfileController::class, 'favorites'])->name('profile.favorites');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Routes publiques
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/questions/{question}', action: [QuestionController::class, 'show'])->name('questions.show');
Route::get('/questions/search', [QuestionController::class, 'search'])->name('questions.search');*/
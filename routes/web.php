<?php

// routes/web.php

use App\Http\Controllers\Front\AccueilController;
use App\Http\Controllers\Front\ArticleController;
use App\Http\Controllers\Front\CompetenceController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\ExperienceController;
use App\Http\Controllers\Front\FormationController;
use App\Http\Controllers\Front\ProjetController;
use Illuminate\Support\Facades\Route;

// Routes API pour le front SPA
Route::prefix('api')->group(function () {
    // Accueil - Données globales
    Route::get('/accueil', [AccueilController::class, 'index']);

    // Projets
    Route::get('/projets', [ProjetController::class, 'index']);
    Route::get('/projets/{projet:slug}', [ProjetController::class, 'show']);

    // Compétences
    Route::get('/competences', [CompetenceController::class, 'index']);

    // Expériences & Formations
    Route::get('/parcours', [ExperienceController::class, 'index']);

    // Blog/Articles
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{article:slug}', [ArticleController::class, 'show']);

    // Contact
    Route::post('/contact', [ContactController::class, 'store']);

    // Expériences
    Route::get('/parcours', [ExperienceController::class, 'index']);

    // Formations
    Route::get('/formations', [FormationController::class, 'index']);
});

// Route catch-all pour le SPA (doit être la dernière)
Route::get('/{any?}', function () {
    return view('spa');
})->where('any', '.*');

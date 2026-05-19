<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExhibitionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'creator') {
        return view('creator.dashboard');
    }
    return view('visitor.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/info', function() { return view('profile.show'); })->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/upgrade', [ProfileController::class, 'upgradeRole'])->name('profile.upgrade');
    
    // Core Platform Routes
    Route::get('/hall/{id?}', [ExhibitionController::class, 'hall'])->name('hall');
    Route::get('/auditorium', [ExhibitionController::class, 'auditorium'])->name('auditorium');
    Route::get('/booths', [ExhibitionController::class, 'booths'])->name('booths');
    
    // Feedback
    Route::get('/feedback', [ExhibitionController::class, 'feedback'])->name('feedback');
    Route::post('/feedback', [ExhibitionController::class, 'storeFeedback'])->name('feedback.store');

    // Pages
    Route::get('/about', [ExhibitionController::class, 'about'])->name('about');
    Route::get('/contact', [ExhibitionController::class, 'contact'])->name('contact');
    Route::post('/contact', [ExhibitionController::class, 'storeContact'])->name('contact.store');

    // Advanced Features API Routes
    Route::post('/api/chatbot', [\App\Http\Controllers\FeatureController::class, 'chatbot']);
    Route::post('/api/earn-points', [\App\Http\Controllers\FeatureController::class, 'earnPoints']);
    Route::post('/api/record-view', [\App\Http\Controllers\FeatureController::class, 'recordView']);
    Route::get('/api/chat', [\App\Http\Controllers\FeatureController::class, 'getChatMessages']);
    Route::post('/api/chat', [\App\Http\Controllers\FeatureController::class, 'storeChatMessage']);
});

// Creator Only Routes
Route::middleware(['auth', 'creator'])->group(function () {
    Route::get('/creator/exhibitions/create', [ExhibitionController::class, 'create'])->name('exhibition.create');
    Route::post('/creator/exhibitions', [ExhibitionController::class, 'store'])->name('exhibition.store');
    Route::post('/creator/exhibit-item', [ExhibitionController::class, 'storeExhibitItem'])->name('exhibit.item.store');
    
    Route::get('/creator/booths/create', [ExhibitionController::class, 'createBooth'])->name('booth.create');
    Route::post('/creator/booths', [ExhibitionController::class, 'storeBooth'])->name('booth.store');
    
    Route::get('/creator/sessions/create', [ExhibitionController::class, 'createSession'])->name('session.create');
    Route::post('/creator/sessions', [ExhibitionController::class, 'storeSession'])->name('session.store');
});

require __DIR__.'/auth.php';

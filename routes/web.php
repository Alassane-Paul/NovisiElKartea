<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\ContactController;

// routes/web.php
Route::get('/', [HomeController::class, 'index'])->name('home');

// Conócenos
Route::get('/conocernos', [AboutController::class, 'index'])->name('about.index');
Route::get('/conocernos/que-es', [AboutController::class, 'what'])->name('about.what');
Route::get('/conocernos/quienes-somos', [AboutController::class, 'who'])->name('about.who');
Route::get('/conocernos/alianzas', [AboutController::class, 'partners'])->name('about.partners');

// Qué hacemos (par thème)
Route::get('/que-hacemos', [ServicesController::class, 'index'])->name('services.index');
Route::get('/que-hacemos/educacion', [ServicesController::class, 'education'])->name('services.education');
Route::get('/que-hacemos/interculturalidad', [ServicesController::class, 'intercultural'])->name('services.intercultural');
// ... autres thèmes

// Projets
Route::get('/proyectos', [ProjectsController::class, 'index'])->name('projects.index');
Route::get('/proyectos/afrikarte', [ProjectsController::class, 'afrikarte'])->name('projects.afrikarte');
Route::get('/proyectos/diversidad', [ProjectsController::class, 'diversity'])->name('projects.diversity');
Route::get('/proyectos/igualdad', [ProjectsController::class, 'equality'])->name('projects.equality');
Route::get('/proyectos/new-generation', [ProjectsController::class, 'newGeneration'])->name('projects.new-generation');

// Adhésion
Route::get('/asociate', [JoinController::class, 'index'])->name('join.index');
Route::post('/asociate', [JoinController::class, 'store'])->name('join.store');

// Contact
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

 // Changement de Langue tout simple
Route::get('/lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return back();
})->name('lang.switch');

// Routes Admin
Route::prefix('cpanel')->name('admin.')->group(function () {
    
    // Auth
    Route::get('/login', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('logout');
    
    // Register
    Route::get('/register', [App\Http\Controllers\Admin\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Admin\RegisterController::class, 'register']);

    // Dashboard (Protected)
    Route::middleware('auth')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Resources
        Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('team', App\Http\Controllers\Admin\TeamMemberController::class);
        Route::resource('partners', App\Http\Controllers\Admin\PartnerController::class);
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class);

        // Paramètres
        Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

        // Traductions
        Route::post('translations/import', [App\Http\Controllers\Admin\TranslationController::class, 'import'])->name('translations.import');
        Route::resource('translations', App\Http\Controllers\Admin\TranslationController::class);
    });
});
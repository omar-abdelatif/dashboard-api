<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\SocialLinksController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TestmonialsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    //! Dashboard Routes
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //! Projects Routes
    Route::get('all_projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('store', [ProjectController::class, 'store'])->name('projects.store');
    //! Category Routes
    Route::get('all_categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('store_category', [CategoryController::class, 'store'])->name('categories.store');
    //! Tags Routes
    Route::get('all_tags', [TagsController::class, 'index'])->name('tags.index');
    Route::post('store_tags', [TagsController::class, 'store'])->name('tags.store');
    //! Testmonials Routes
    Route::get('all_testmonials', [TestmonialsController::class, 'index'])->name('testmonials.index');
    //! Blogs Routes
    Route::get('all_blogs', [BlogController::class, 'index'])->name('blogs.index');
    //! Skills Routes
    Route::get('all_skills', [SkillsController::class, 'index'])->name('skills.index');
    Route::post('store_skill', [SkillsController::class, 'store'])->name('skills.store');
    Route::get('delete_skill/{id}', [SkillsController::class, 'destroy'])->name('skills.destroy');
    //! Services Routes
    Route::get('all_services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('store_services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('delete_services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::post('update_service', [ServiceController::class, 'update'])->name('services.update');
    //! Information Routes
    Route::get('all_infos', [InformationController::class, 'index'])->name('infos.index');
    //! Social Links Routes
    Route::get('all_links', [SocialLinksController::class, 'index'])->name('links.index');
});

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

Auth::routes(['verify' => true]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::
    Route::view('about', 'about')->name('about');
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    //! Dashboard Routes
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //! Projects Routes
    Route::get('all_projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('delete_project/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::post('update_project', [ProjectController::class, 'update'])->name('projects.update');
    //! Category Routes
    Route::get('all_categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('store_category', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('update_category', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('delete_category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    //! Tags Routes
    Route::get('all_tags', [TagsController::class, 'index'])->name('tags.index');
    Route::post('store_tags', [TagsController::class, 'store'])->name('tags.store');
    Route::get('delete_tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');
    Route::post('update_tags', [TagsController::class, 'update'])->name('tags.update');
    //! Testmonials Routes
    Route::get('all_testmonials', [TestmonialsController::class, 'index'])->name('testmonials.index');
    Route::post('store_testmonials', [TestmonialsController::class, 'store'])->name('testmonials.store');
    Route::post('update_testmonials', [TestmonialsController::class, 'update'])->name('testmonials.update');
    Route::get('destroy_testmonials/{id}', [TestmonialsController::class, 'destroy'])->name('testmonials.destroy');
    //! Blogs Routes
    Route::get('all_blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::post('store_blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('delete_blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::post('update_blogs', [BlogController::class, 'update'])->name('blogs.update');
    //! Skills Routes
    Route::get('all_skills', [SkillsController::class, 'index'])->name('skills.index');
    Route::post('store_skill', [SkillsController::class, 'store'])->name('skills.store');
    Route::get('delete_skill/{id}', [SkillsController::class, 'destroy'])->name('skills.destroy');
    Route::post('update_skills', [SkillsController::class, 'update'])->name('skills.update');
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

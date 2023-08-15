<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InformationController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SkillsController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\TestmonialsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('all_projects', ProjectController::class);
Route::apiResource('all_categories', CategoryController::class);
Route::apiResource('all_skills', SkillsController::class);
Route::apiResource('all_services', ServiceController::class);
Route::apiResource('all_tags', TagsController::class);
Route::apiResource('all_testmonials', TestmonialsController::class);
Route::apiResource('informations', InformationController::class);
Route::apiResource('all_blogs', BlogController::class);

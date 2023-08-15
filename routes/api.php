<?php

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SkillsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('all_projects', ServiceController::class);
Route::apiResource('all_categories', ServiceController::class);
Route::apiResource('all_skills', SkillsController::class);
Route::apiResource('all_services', ServiceController::class);
Route::apiResource('all_tags', ServiceController::class);
Route::apiResource('all_testmonials', ServiceController::class);
Route::apiResource('informations', ServiceController::class);
Route::apiResource('all_blogs', ServiceController::class);

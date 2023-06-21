<?php

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SkillsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('all_skills', SkillsController::class);
Route::apiResource('all_services', ServiceController::class);

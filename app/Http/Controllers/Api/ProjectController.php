<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $skills = Project::all();
        return response()->json([
            'status' => true,
            'skills' => $skills
        ], 200);
    }
}

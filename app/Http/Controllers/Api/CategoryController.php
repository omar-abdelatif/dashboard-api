<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $skills = Category::all();
        return response()->json([
            'status' => true,
            'skills' => $skills
        ], 200);
    }
}

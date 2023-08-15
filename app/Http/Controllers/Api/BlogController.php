<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $skills = Blog::all();
        return response()->json([
            'status' => true,
            'skills' => $skills
        ], 200);
    }
}

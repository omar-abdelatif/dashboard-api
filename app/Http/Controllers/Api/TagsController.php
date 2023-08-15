<?php

namespace App\Http\Controllers\Api;

use App\Models\Tags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index()
    {
        $skills = Tags::all();
        return response()->json([
            'status' => true,
            'skills' => $skills
        ], 200);
    }
}

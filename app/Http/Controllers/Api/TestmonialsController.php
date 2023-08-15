<?php

namespace App\Http\Controllers\Api;

use App\Models\Testmonials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestmonialsController extends Controller
{
    public function index()
    {
        $skills = Testmonials::all();
        return response()->json([
            'status' => true,
            'skills' => $skills
        ], 200);
    }
}

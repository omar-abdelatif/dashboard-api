<?php

namespace App\Http\Controllers\Api;

use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    public function index()
    {
        $skills = Information::all();
        return response()->json([
            'status' => true,
            'skills' => $skills
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestmonialsController extends Controller
{
    public function index()
    {
        $pageTitle = 'Testmonials';
        return view('Testmonials.index', compact('pageTitle'));
    }
}

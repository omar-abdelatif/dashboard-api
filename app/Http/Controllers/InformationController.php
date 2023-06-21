<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $pageTitle = 'Information';
        return view('Information.index', compact('pageTitle'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $pageTitle = 'Blog';
        return view('Blogs.index', compact('pageTitle'));
    }
}

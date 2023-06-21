<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocialLinksController extends Controller
{
    public function index()
    {
        $pageTitle = 'SocialLinks';
        return view('SocialLinks.index', compact('pageTitle'));
    }
}

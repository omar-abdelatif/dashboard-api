<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified']);
    }
    public function index(){
        $pageTitle = 'Dashboard';
        $project_count = Project::count();
        return view('home', compact('pageTitle', 'project_count'));
    }
    public function update()
    {

    }
}

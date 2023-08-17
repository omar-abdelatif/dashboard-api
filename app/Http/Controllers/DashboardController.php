<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $pageTitle = 'Dashboard';
        $project_count = Project::count();
        return view('home', compact('pageTitle', 'project_count'));
    }
    public function UploadAvatar(Request $request)
    {
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
        }
    }
}

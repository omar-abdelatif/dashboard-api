<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $pageTitle = 'Projects';
        $categories = Category::all();
        $tags = Tags::all();
        $projects = Project::all();
        return view('Projects.index', compact('pageTitle', 'categories', 'tags', 'projects'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required',
            'tags' => 'required',
            'github' => 'required',
            'url' => 'required'
        ]);
        if ($request->hasFile('img')) {
            $upload = $request->file('img');
            $name = time() . '.' . $upload->getClientOriginalExtension();
            $destinationPath = public_path('assets/imgs/projects/');
            $upload->move($destinationPath, $name);
        } elseif (!$request->file('img')) {
            $name = 'download.png';
        }
        $category = Category::where('title', $validated['category'])->first();
        $tags = Tags::where('title', $validated['tags'])->first();
        $store = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'tags' => $validated['tags'],
            'github' => $validated['github'],
            'url' => $validated['url'],
            'img' => $name,
            'category_id' => $category->id,
            'tag_id' => $tags->id,
        ]);
        if($store){
            return redirect()->route('projects.index')->with('success', 'Project Inserted Successfully');
        }
        return redirect()->route('projects.index')->withErrors($validated);
    }
}

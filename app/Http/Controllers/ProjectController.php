<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $pageTitle = 'Projects';
        $categories = Category::all();
        $tags = Tags::all();
        $projects = Project::all();
        foreach ($projects as $project) {
            $multiAnswers = $project->tags;
            $answers = explode(',', $multiAnswers);
        }
        return view('Projects.index', compact('pageTitle', 'categories', 'tags', 'answers', 'projects'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required',
            'tags' => 'required|array',
            'tags.*' => 'required|string|distinct',
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
        $all_tags = implode(',', $request->input('tags'));
        $tags = Tags::where('title', $validated['tags'])->first();
        $store = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'tags' => explode(',', $all_tags),
            'github' => $validated['github'],
            'url' => $validated['url'],
            'img' => $name,
            'category_id' => $category->id,
            'tag_id' => explode(',', $tags->id),
        ]);
        if ($store) {
            return redirect()->route('projects.index')->with('success', 'Project Inserted Successfully');
        } else {
            return redirect()->route('projects.index')->withErrors($validated);
        }
    }
    public function destroy($id)
    {
        $project = Project::find($id);
        if ($project) {
            $project->delete();
            return redirect()->route('projects.index')->withSuccess("Deleted successfully");
        }
        return redirect()->route('projects.index')->withErrors('Error Happen');
    }
    public function update(Request $request)
    {
        $project =  Project::find($request->id);
        if ($project) {
            $project->title = $request->title;
            $project->description = $request->description;
            $project->category = $request->category;
            $project->tags = $request->tags;
            $project->github = $request->github;
            $project->url = $request->url;
            $update = $project->save();
            if ($update)
                return redirect()->route('projects.index')->withSuccess("Updated successfully");
        }
        return redirect()->route('projects.index')->withErrors('Error Happen');
    }
}

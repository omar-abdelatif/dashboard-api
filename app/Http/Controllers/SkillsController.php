<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index()
    {
        $skills = Skills::all();
        $categories = Category::all();
        $pageTitle = 'Skills';
        return view('Skills.index', compact('pageTitle', 'skills', 'categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required',
        ]);
        if ($request->hasFile('img')) {
            $upload = $request->file('img');
            $name = time() . '.' . $upload->getClientOriginalExtension();
            $destinationPath = public_path('assets/imgs/skills/');
            $upload->move($destinationPath, $name);
        } elseif (!$request->file('img')) {
            $name = 'download.png';
        }
        $category = Category::where('title', $validated['category'])->first();
        $store = Skills::create([
            'category' => $validated['category'],
            'img' => $name,
            'category_id' => $category->id,
        ]);
        if ($store) {
            return redirect()->route('skills.index')->with('success', 'Skill Inserted Successfully');
        }
        return redirect()->route('skills.index')->withErrors($validated);
    }
    public function destroy($id)
    {
        $skills = Skills::find($id);
        if ($skills) {
            if ($skills->img !== null) {
                $oldPath = public_path('assets/imgs/skills/' . $skills->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $skills->delete();
            return redirect()->route('skills.index')->with('success', 'Skill Deleted Successfully');
        }
        return redirect()->route('skills.index')->withErrors('Error Happen');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $pageTitle = 'Tags';
        return view('Tags.index', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required'
        ]);
        $store = Tags::create($validated);
        if ($store) {
            return redirect()->route('tags.index')->with('success', 'Tag Inserted Successfully');
        }
        return redirect()->route('tags.index')->withErrors($validated);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::all();
        $pageTitle = 'Tags';
        return view('Tags.index', compact('pageTitle', 'tags'));
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
    public function update(Request $request)
    {
        $tags = Tags::find($request->id);
        if ($tags) {
            $update = $tags->update($request->all());
            if ($update) {
                return redirect()->route('tags.index')->withSuccess('Updated Successfully');
            }
            return redirect()->route('tags.index')->withErrors('Error Happen');
        }
    }
    public function destroy($id)
    {
        $tags = Tags::find($id);
        if ($tags) {
            $tags->delete();
            return redirect()->route('tags.index')->withSuccess('Deleted Successfully');
        }
        return redirect()->route('tags.index')->withErrors('Error Happen');
    }
}

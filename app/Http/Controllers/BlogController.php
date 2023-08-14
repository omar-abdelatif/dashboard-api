<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $blogs = Blog::all();
        $pageTitle = 'Blog';
        return view('Blogs.index', compact('pageTitle', 'blogs', 'categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'img' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'content' => 'required',
            'category' => 'required'
        ]);
        if ($request->hasFile('img')) {
            $upload = $request->file('img');
            $name = time() . '.' . $upload->getClientOriginalExtension();
            $destinationPath = public_path('assets/imgs/blogs/');
            $upload->move($destinationPath, $name);
        } elseif (!$request->file('img')) {
            $name = 'download.png';
        }
        $category = Category::where('title', $validated['category'])->first();
        $store = Blog::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'content' => $validated['content'],
            'img' => $name,
            'category_id' => $category->id
        ]);
        if ($store) {
            return redirect()->route('blogs.index')->with('success', 'Blog Inserted Successfully');
        } else {
            return redirect()->route('blogs.index')->withErrors($validated);
        }
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            if ($blog->img !== null) {
                $oldPath = public_path('assets/imgs/blogs/' . $blog->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $blog->delete();
            return redirect()->route('blogs.index')->withSuccess('Deleted Successfully');
        }
        return redirect()->route('blogs.index')->withErrors('Error Happen');
    }
}

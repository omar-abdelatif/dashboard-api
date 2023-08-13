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
        // $validated = $request->validate([
        //     'title' => 'required|min:5',
        //     'img' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        //     'content' => 'required|min:10',
        //     'category' => 'required'
        // ]);
        $category = Category::where('title', $request->title)->first();
        dd($category);
        // if ($request->hasFile('img')) {
        //     $upload = $request->file('img');
        //     $name = time() . '.' . $upload->getClientOriginalExtension();
        //     $destinationPath = public_path('assets/imgs/blogs/');
        //     $upload->move($destinationPath, $name);
        // } elseif (!$request->file('img')) {
        //     $name = 'download.png';
        // }
        // $store = Blog::create([]);
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

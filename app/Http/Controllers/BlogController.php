<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $admins = User::all();
        $categories = Category::all();
        $blogs = Blog::all();
        $pageTitle = 'Blog';
        return view('Blogs.index', compact('pageTitle', 'blogs', 'categories', 'admins'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate(['author' => 'required',
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
        $store = Blog::create(['author' => $validated['author'],
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
    public function update(Request $request)
    {
        $blog = Blog::find($request->id);
        if ($blog) {
            //! Delete Old Img
            if ($request->hasFile('img') && $blog->img !== null) {
                $oldPath = public_path('assets/imgs/Blogs/' . $blog->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            //! Upload New Image
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $upload = $request->file('img');
                $name = time() . '.' . $upload->getClientOriginalExtension();
                $destinationPath = public_path('assets/imgs/blogs/');
                $upload->move($destinationPath, $name);
                $blog->img = $name;
            } elseif (!$request->file('img')) {
                $name = 'download.png';
            }
            $blog->author = $request->author;
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->category = $request->category;
            //! Update Data in Database
            $update =  $blog->save();
            if ($update) {
                return redirect()->route('blogs.index')->withSuccess("Updated SuccessFully");
            }
        } else {
            return redirect()->route('blogs.index')->withErrors("Error While Updating");
        }
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            if ($blog->img !== null) {
                $oldPath = public_path('assets/imgs/Blogs/' . $blog->img);
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

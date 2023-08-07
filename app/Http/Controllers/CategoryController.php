<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Category';
        $categories = Category::all();
        return view('Categories.index', compact('pageTitle', 'categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required'
        ]);
        $store = Category::create($validated);
        if ($store) {
            return redirect()->route('categories.index')->withSuccess("Inserted successfully");
        }
        return redirect()->route('categories.index')->withErrors($validated);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->route('categories.index')->withSuccess("Deleted successfully");
        }
        return redirect()->route('categories.index')->withErrors('Error Happen');
    }
    public function update(Request $request)
    {
        $category =  Category::find($request->id);
        if ($category) {
            $update = $category->update($request->all());
            if ($update) {
                return redirect()->route('categories.index')->withSuccess("Updated successfully");
            }
        }
        return redirect()->route('categories.index')->withErrors('Error Happen');
    }
}

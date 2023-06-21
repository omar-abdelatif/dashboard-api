<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Category';
        return view('categories.index', compact('pageTitle'));
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required'
        ]);
        $store = Category::create($validated);
        if($store){
            return redirect()->route('categories.index')->with('success', 'Category Inserted Successfully');
        }
        return redirect()->route('categories.index')->withErrors($validated);
    }
}

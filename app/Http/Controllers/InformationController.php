<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $info = Information::all();
        $pageTitle = 'Information';
        return view('Information.index', compact('pageTitle', 'info'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => 'required',
            'age' => 'required|max:3|min:1|numeric|integer',
            'address' => 'required|alpha_num|max:100',
            'phone_number' => 'required|numeric|integer|max:15',
            'email' => 'required|email',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('img')) {
            $upload = $request->file('img');
            $name = time() . '.' . $upload->getClientOriginalExtension();
            $destinationPath = public_path('assets/imgs/information/');
            $upload->move($destinationPath, $name);
        } elseif (!$request->file('img')) {
            $name = 'download.png';
        }
        $store = Information::create([
            'name' => $validated['name'],
            'age' => $validated['age'],
            'address' => $validated['address'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'img' => $name
        ]);
    }
}

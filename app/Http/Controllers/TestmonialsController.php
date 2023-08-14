<?php

namespace App\Http\Controllers;

use App\Models\Testmonials;
use Illuminate\Http\Request;

class TestmonialsController extends Controller
{
    public function index()
    {
        $testmonials = Testmonials::all();
        $pageTitle = 'Testmonials';
        return view('Testmonials.index', compact('pageTitle', 'testmonials'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required',
            'title' => 'required',
            'img' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);
        if ($request->hasFile('img')) {
            $upload = $request->file('img');
            $name = time() . '.' . $upload->getClientOriginalExtension();
            $destinationPath = public_path('assets/imgs/testmonials/');
            $upload->move($destinationPath, $name);
        } elseif (!$request->file('img')) {
            $name = 'download.png';
        }
        $store = Testmonials::create([
            'client_name' => $validated['client_name'],
            'title' => $validated['title'],
            'img' => $name,
        ]);
        if ($store) {
            return redirect()->route('testmonials.index')->withSuccess('Testmonial Inserted Successfully');
        } else {
            return redirect()->route('testmonials.index')->withErrors($validated);
        }
    }
    public function update(Request $request)
    {
        $validated = "Error Happen";
        $testmonial = Testmonials::find($request->id);
        if ($testmonial) {
            //! Delete Old Img
            if ($request->hasFile('img') && $testmonial->img !== null) {
                $oldPath = public_path('assets/imgs/testmonials/' . $testmonial->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            //! Upload New Image
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $upload = $request->file('img');
                $name = time() . '.' . $upload->getClientOriginalExtension();
                $destinationPath = public_path('assets/imgs/testmonials/');
                $upload->move($destinationPath, $name);
                $testmonial->img = $name;
            } elseif (!$request->file('img')) {
                $name = 'download.png';
            }
            $testmonial->client_name = $request->client_name;
            $testmonial->title       = $request->title;
            $update = $testmonial->save();
            if ($update) {
                return redirect()->route('testmonials.index')->withSuccess('Updated Successfully');
            } else {
                return redirect()->route('testmonials.index')->withErrors($validated);
            }
        }
    }
    public function destroy($id)
    {
        $testmonials = Testmonials::find($id);
        if ($testmonials) {
            if ($testmonials->img !== null) {
                $oldPath = public_path('assets/imgs/testmonials/' . $testmonials->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $testmonials->delete();
            return redirect()->route('testmonials.index')->withSuccess('Deleted Successfully');
        }
        return redirect()->route('testmonials.index')->withErrors('Error Happen');
    }
}

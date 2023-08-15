<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $infos = Information::all();
        $pageTitle = 'Information';
        return view('Information.index', compact('pageTitle', 'infos'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate(["name" => 'required|string',
            'age' => 'required|numeric|integer',
            'address' => 'required|alpha_num|max:100',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
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
        if ($store) {
            return redirect()->route('infos.index')->withSuccess('Inserted Successfully');
        }
        return redirect()->route('infos.index')->withErrors($validated);
    }
    public function update(Request $request)
    {
        $info = Information::find($request->id);
        if ($info) {
            //! Delete Old Image
            if ($request->hasFile('img') && $info->img !== null) {
                $oldPath = public_path('assets/imgs/information/' . $info->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            //! Upload New Image
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $upload = $request->file('img');
                $name = time() . '.' . $upload->getClientOriginalExtension();
                $destinationPath = public_path('assets/imgs/information/');
                $upload->move($destinationPath, $name);
                $info->img = $name;
            }
            //! Update Data
            $info->name = $request->name;
            $info->age = $request->age;
            $info->phone_number = $request->phone_number;
            $info->email = $request->email;
            $info->address = $request->address;
            $update = $info->save();
            if ($update) {
                return redirect()->route('infos.index')->withSuccess('Updated Successfully');
            }
        } else {
            return redirect()->route('infos.index')->withErrors('Error Happen');
        }
    }
    public function destroy($id)
    {
        $info = Information::find($id);
        if ($info) {
            if ($info->img !== null) {
                $oldPath = public_path('assets/imgs/information/' . $info->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $info->delete();
            return redirect()->route('infos.index')->withSuccess('Deleted Successfully');
        }
        return redirect()->route('infos.index')->withErrors('Error Happen');
    }
}

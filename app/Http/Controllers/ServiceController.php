<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $pageTitle = 'Services';
        return view('Services.index', compact('pageTitle', 'services'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'max:500',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            $upload = $request->file('logo');
            $name = time() . '.' . $upload->getClientOriginalExtension();
            $destinationPath = public_path('assets/imgs/services/');
            $upload->move($destinationPath, $name);
        } elseif (!$request->file('logo')) {
            $name = 'download.png';
        }
        $store = Service::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'logo' => $name,
        ]);
        if ($store) {
            return redirect()->route('services.index')->with('success', 'Project Inserted Successfully');
        }
        return redirect()->route('services.index')->withErrors($validated);
    }
    public function update(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'max:500',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $service = Service::find($request->id);
        if($service){
            if ($request->hasFile('logo') && $service->logo !== null) {
                $oldImagePath = public_path('assets/imgs/services/' . $service->logo);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            if ($request->hasFile('logo')) {
                $upload = $request->file('logo');
                $name = time() . '.' . $upload->getClientOriginalExtension();
                $destinationPath = public_path('assets/imgs/services/');
                $upload->move($destinationPath, $name);
                $service->logo = $name;
            }
            $service->title = $validated['title'];
            $service->description = $validated['description'];
            $update = $service->save();
            if($update){
                return redirect()->route('services.index')->with('success', 'Service Updated Successfully');
            }
        }
        return redirect()->route('services.index')->withErrors($validated);
    }
    public function destroy($id)
    {
        $services = Service::find($id);
        if ($services) {
            if ($services->img !== null) {
                $oldPath = public_path('assets/imgs/services/' . $services->img);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $services->delete();
            return redirect()->route('services.index')->with('success', 'Service Deleted Successfully');
        }
        return redirect()->route('services.index')->withErrors('Error Happen');
    }
}

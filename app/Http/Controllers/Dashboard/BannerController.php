<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }
    public function create()
    {
        return view('admin.banner.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/banners';
            if (!File::isDirectory(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true, true);
            }
            $image->move(public_path($imagePath), $imageName);
                $validatedData['image'] = env('URL') . '/' . $imagePath . '/' . $imageName;
        }
        $banner = Banner::create([
            'title_ar' => $validatedData['title_ar'],
            'title_en' => $validatedData['title_en'],
            'description_ar' => $validatedData['description_ar'],
            'description_en' => $validatedData['description_en'],
            'image' => $validatedData['image'],
        ]);
        return redirect()->route('banners.index')->with('successCreate','Banner created successfully');
    }
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('banner'));
    }
    public function show($id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.show', compact('banner'));
    }
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        $validatedData = $request->validate([
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/banners';
            if (!File::isDirectory(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true, true);
            }
            $image->move(public_path($imagePath), $imageName);
                $validatedData['image'] = env('URL') . '/' . $imagePath . '/' . $imageName ;
        }
        $banner->update([
            'title_ar' => $validatedData['title_ar'],
            'title_en' => $validatedData['title_en'],
            'description_ar' => $validatedData['description_ar'],
            'description_en' => $validatedData['description_en'],
            'image' => $validatedData['image'] ?? $banner->image,
        ]);
        return redirect()->route('banners.index')->with('successUpdate','Banner updated successfully');
    }
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if($banner->image){
            $imagePath = $banner->image;
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
        }
        $banner->delete();
        return redirect()->route('banners.index')->with('successDelete','Banner deleted successfully');
    }
}

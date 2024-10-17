<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('products')->get();
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'name_ar.required' => 'Name (Arabic) is required',
            'name_ar.string' => 'Name (Arabic) must be a string',
            'name_ar.max' => 'Name (Arabic) must be less than 255 characters',
            'name_en.required' => 'Name (English) is required',
            'name_en.string' => 'Name (English) must be a string',
            'name_en.max' => 'Name (English) must be less than 255 characters',
            'logo.required' => 'Logo is required',
            'logo.image' => 'Logo must be an image',
        ]
    );
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/brands';
            if (!File::isDirectory(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true, true);
            }
            $image->move(public_path($imagePath), $imageName);
                $validatedData['logo'] = env('URL') . '/' . $imagePath . '/' . $imageName;
        }
        $brand = Brand::create([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'logo' => $validatedData['logo'],
        ]);
        return redirect()->route('brands.index')->with('successCreate','Brand created successfully');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            if ($brand->logo && file_exists(public_path($brand->logo))) {
                unlink(public_path($brand->logo));
            }
            $logo = $request->file('logo');
            $logoName = time().'.'.$logo->getClientOriginalExtension();
            $imagePath = 'images/brands/'.$logoName;
            $logo->move(public_path('images/brands'), $logoName);
            $validatedData['logo'] = $imagePath;
        }
        $brand->update([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'logo' => $imagePath,
        ]);
        return redirect()->route('brands.index')->with('successUpdate','Brand updated successfully');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        if($brand->logo){
            $imagePath = $brand->logo;
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
        }
        return redirect()->route('brands.index')->with('successDelete','Brand deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'name_ar.required' => 'The Arabic name is required',
            'name_en.required' => 'The English name is required',
            'logo.required' => 'The logo is required',
            'logo.image' => 'The logo must be an image',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, svg',
            'logo.max' => 'The logo must not be greater than 2048 kilobytes',
        ]
    );
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/categories';
            if (!File::isDirectory(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true, true);
            }
            $image->move(public_path($imagePath), $imageName);
                $validatedData['logo'] = env('URL') . '/' . $imagePath . '/' . $imageName;
        }
        $category = Category::create([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'logo' => $validatedData['logo'],
        ]);
        if($category){
            return redirect()->route('categories.index')->with('successCreate', trans('admin.category_created_successfully'));
        }else{
            return redirect()->route('categories.create')->with('errorCreate', trans('admin.category_created_error'));
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        Log::info($request->all());
        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'name_ar.required' => 'The Arabic name is required',
            'name_en.required' => 'The English name is required',
            'logo.image' => 'The logo must be an image',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, gif, svg',
            'logo.max' => 'The logo must not be greater than 2048 kilobytes',
        ]);
        if ($request->hasFile('logo')) {
            if ($category->logo && file_exists(public_path($category->logo))) {
                unlink(public_path($category->logo));
            }
                $image = $request->file('logo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/images/categories';
                if (!File::isDirectory(public_path($imagePath))) {
                    File::makeDirectory(public_path($imagePath), 0755, true, true);
                }
                $image->move(public_path($imagePath), $imageName);
                $validatedData['logo'] = env('URL') . '/' . $imagePath . '/' . $imageName;
        }
        $category->update([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'logo' => $validatedData['logo'] ?? $category->logo,
        ]);
        return redirect()->route('categories.index')->with('success',trans('admin.category_updated_successfully'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success',trans('admin.category_deleted_successfully'));
    }
}

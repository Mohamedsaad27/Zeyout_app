<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
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
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time().'.'.$logo->getClientOriginalExtension();
            $imagePath = 'images/categories/'.$logoName;
            $logo->move(public_path('images/categories'), $logoName);
        }
        $category = Category::create([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'logo' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', trans('admin.category_created_successfully'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            if ($category->logo && file_exists(public_path($category->logo))) {
                unlink(public_path($category->logo));
            }
            $logo = $request->file('logo');
            $logoName = time().'.'.$logo->getClientOriginalExtension();
            $imagePath = 'images/categories/'.$logoName;
            $logo->move(public_path('images/categories'), $logoName);
        }
        $category->update([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'logo' => $imagePath,
        ]);
        return redirect()->route('categories.index')->with('success',trans('admin.category_updated_successfully'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success',trans('admin.category_deleted_successfully'));
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','brand','product_variants','relatedProducts')->get();
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'product_variants' => 'required|array',
            'product_variants.*.size' => 'required|string|max:50',
            'product_variants.*.mileage' => 'required|string|max:50',
            'product_variants.*.wholesale_price' => 'required|numeric|min:0',
            'product_variants.*.unit_price' => 'required|numeric|min:0',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'images/products/'.$imageName;
            $image->move(public_path('images/products'), $imageName);
            $validatedData['image'] = $imagePath;
        }
        $product = Product::create($validatedData);
        return redirect()->route('products.index')->with('success',trans('messages.product_created_successfully'));
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'product_variants' => 'required|array',
            'product_variants.*.size' => 'required|string|max:50',
            'product_variants.*.mileage' => 'required|string|max:50',
            'product_variants.*.wholesale_price' => 'required|numeric|min:0',
            'product_variants.*.unit_price' => 'required|numeric|min:0',
        ]);
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'images/products/'.$imageName;
            $image->move(public_path('images/products'), $imageName);
            $validatedData['image'] = $imagePath;
        }
        $product->update($validatedData);
        return redirect()->route('products.index')->with('success',trans('messages.product_updated_successfully'));
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));   
        }
        $product->delete();
        return redirect()->route('products.index')->with('success',trans('messages.product_deleted_successfully'));
    }
}

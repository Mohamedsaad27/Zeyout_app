<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories','brand','product_variants','relatedProducts')->paginate(10);
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
            'api' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'product_variants' => 'required|array|min:1',
            'product_variants.*.size' => 'nullable|string|max:50',
            'product_variants.*.mileage' => 'nullable|string|max:50',
            'product_variants.*.wholesale_price' => 'nullable|numeric|min:0',
            'product_variants.*.unit_price' => 'nullable|numeric|min:0',
        ]);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/products';
            if (!File::isDirectory(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true, true);
            }
            $image->move(public_path($imagePath), $imageName);
                $validatedData['image'] = env('URL') . '/' . $imagePath . '/' . $imageName;
        }
        $product = Product::create($validatedData);
        
        if($request->has('categories')){
            $product->categories()->attach($request->categories);
        }
        foreach ($request->product_variants as $variant) {
            $product->product_variants()->create($variant);
        }

        return redirect()->route('products.index')->with('success',trans('messages.product_created_successfully'));
    }
    public function edit($id)
    {
        $product = Product::with('product_variants')->find($id);
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

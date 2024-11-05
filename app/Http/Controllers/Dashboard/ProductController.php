<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Trader;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories', 'brand', 'product_variants', 'relatedProducts')->paginate(10);
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $traders = Trader::with('user')->get();
        return view('admin.products.create', compact('categories', 'brands', 'traders'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'description_ar' => 'required|string',
                'description_en' => 'required|string',
                'api' => 'nullable|numeric|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'categories' => 'required|array|min:1',
                'categories.*' => 'exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'product_variants' => 'required|array|min:1',
                'product_variants.*.size' => 'nullable|string|max:50',
                'product_variants.*.mileage' => 'nullable|string|max:50',
                'product_variants.*.wholesale_price' => 'nullable|numeric|min:0',
                'product_variants.*.unit_price' => 'nullable|numeric|min:0',
                'trader_id' => 'required|exists:traders,id',
            ],
            [
                'name_ar.required' => 'The Arabic name field is required.',
                'name_en.required' => 'The English name field is required.',
                'description_ar.required' => 'The Arabic description field is required.',
                'description_en.required' => 'The English description field is required.',
                'api.numeric' => 'The API field must be a number.',
                'api.min' => 'The API field must be at least 0.',
                'image.required' => 'The image field is required.',
                'image.image' => 'The image must be an image.',
                'image.mimes' => 'The image must be a valid image file.',
                'image.max' => 'The image may not be greater than 2048 kilobytes.',
                'categories.required' => 'The categories field is required.',
                'categories.array' => 'The categories field must be an array.',
                'categories.min' => 'The categories field must have at least 1 category.',
                'categories.*.exists' => 'The selected category is invalid.',
                'brand_id.required' => 'The brand field is required.',
                'brand_id.exists' => 'The selected brand is invalid.',
                'product_variants.required' => 'The product variants field is required.',
                'product_variants.array' => 'The product variants field must be an array.',
                'product_variants.min' => 'The product variants field must have at least 1 variant.',
                'product_variants.*.size.required' => 'The size field is required.',
                'product_variants.*.mileage.required' => 'The mileage field is required.',
                'product_variants.*.wholesale_price.required' => 'The wholesale price field is required.',
                'product_variants.*.unit_price.required' => 'The unit price field is required.',
                'trader_id.required' => 'The trader field is required.',
                'trader_id.exists' => 'The selected trader is invalid.',
            ]
        );
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/products';
            if (!File::isDirectory(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true, true);
            }
            $image->move(public_path($imagePath), $imageName);
            $validatedData['image'] = env('URL') . '/' . $imagePath . '/' . $imageName;
        }
        $product = Product::create([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'description_ar' => $validatedData['description_ar'],
            'description_en' => $validatedData['description_en'],
            'api' => $validatedData['api'],
            'image' => $validatedData['image'],
            'brand_id' => $validatedData['brand_id'],
            'trader_id' => $validatedData['trader_id'],
        ]);

        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }
        foreach ($request->product_variants as $variant) {
            $product->product_variants()->create($variant);
        }

        return redirect()->route('products.index')->with('successCreate', 'Product Created Successfully');
    }
    public function edit($id)
    {
        $product = Product::with('product_variants')->find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $traders = Trader::with('user')->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'traders'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $validatedData = $request->validate(
            [
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
            ],
            [
                'name_ar.required' => 'The Arabic name field is required.',
                'name_en.required' => 'The English name field is required.',
                'description_ar.required' => 'The Arabic description field is required.',
                'description_en.required' => 'The English description field is required.',
                'price.required' => 'The price field is required.',
                'price.numeric' => 'The price field must be a number.',
                'price.min' => 'The price field must be at least 0.',
                'image.image' => 'The image must be an image.',
                'image.mimes' => 'The image must be a valid image file.',
                'image.max' => 'The image may not be greater than 2048 kilobytes.',
                'api.numeric' => 'The API field must be a number.',
                'api.min' => 'The API field must be at least 0.',
                'categories.required' => 'The categories field is required.',
                'categories.array' => 'The categories field must be an array.',
                'categories.min' => 'The categories field must have at least 1 category.',
                'categories.*.exists' => 'The selected category is invalid.',
                'brand_id.required' => 'The brand field is required.',
                'brand_id.exists' => 'The selected brand is invalid.',
                'product_variants.required' => 'The product variants field is required.',
                'product_variants.array' => 'The product variants field must be an array.',
                'product_variants.*.size.required' => 'The size field is required.',
                'product_variants.*.mileage.required' => 'The mileage field is required.',
                'product_variants.*.wholesale_price.required' => 'The wholesale price field is required.',
                'product_variants.*.unit_price.required' => 'The unit price field is required.',
            ]
        );
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/products';
            if (!File::isDirectory(public_path($imagePath))) {
                File::makeDirectory(public_path($imagePath), 0755, true, true);
            }
            $image->move(public_path($imagePath), $imageName);
            $validatedData['image'] = env('URL') . '/' . $imagePath . '/' . $imageName;
        }
        $product->update([
            'name_ar' => $validatedData['name_ar'],
            'name_en' => $validatedData['name_en'],
            'description_ar' => $validatedData['description_ar'],
            'description_en' => $validatedData['description_en'],
            'image' => $validatedData['image'] ?? $product->image,
            'brand_id' => $validatedData['brand_id'],
            'api' => $validatedData['api'],
        ]);
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }
        if ($request->has('product_variants')) {
            foreach ($request->product_variants as $variant) {
                $product->product_variants()->updateOrCreate($variant);
            }
        }
        return redirect()->route('products.index')->with('successUpdate', 'Product Updated Successfully');
    }
    public function show($id)
    {
        $product = Product::with('product_variants', 'categories', 'brand', 'relatedProducts')->find($id);
        return view('admin.products.show', compact('product'));
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->image) {
            $imagePath = $product->image;
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
        }
        $product->delete();
        return redirect()->route('products.index')->with('successDelete', 'Product Deleted Successfully');
    }
    public function addVariant(Request $request)
    {
        $lastVariantIndex = $request->input('variants_count', 0);
        $newIndex = $lastVariantIndex + 1;

        $html = view('components.product-varient', [
            'index' => $newIndex
        ])->render();

        return $html;
    }
}

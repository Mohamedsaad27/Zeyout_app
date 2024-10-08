<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\HandleApiResponse;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductRepository implements ProductRepositoryInterface
{
    use HandleApiResponse;
    public function getAllProducts()
    {
        try {
            $products = Product::query()
                ->with('favorites', 'product_variants')
                ->paginate(10);
            if($products->isEmpty()){
                return $this->errorResponse(trans('messages.no_products'), 404);
            }
            return $this->successResponse(ProductResource::collection($products), trans('messages.products_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function getProductById($productId)
    {
        try {
            $product = Product::query()
                ->with('favorites', 'product_variants')
                ->find($productId);
            if(!$product){
                return $this->errorResponse(trans('messages.product_not_found'), 404);
            }
            return $this->successResponse(new ProductResource($product), trans('messages.product_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function filterProducts(Request $request)
    {
        try {
            $query = Product::query();

            if ($categoryName = $request->query('category_name_en')) {
                $query->whereHas('category', function($q) use ($categoryName) {
                    $q->where('name_en', $categoryName);
                });
            }
    
            // Filter by brand
            if ($brandName = $request->query('brand_name_en')) {
                $query->whereHas('brand', function($q) use ($brandName) {
                    $q->where('name_en', $brandName);
                });
            }
    
            // Filter by size (product variant)
            if ($size = $request->query('size')) {
                $query->whereHas('product_variants', function($q) use ($size) {
                    $q->where('size', $size);
                });
            }
    
            // Filter by mileage (product variant)
            if ($mileage = $request->query('mileage')) {
                $query->whereHas('product_variants', function($q) use ($mileage) {
                    $q->where('mileage', $mileage);
                });
            }
    
            // Filter by API
            if ($API = $request->query('API')) {
                $query->where('API', $API);
            }
    
            // Filter by price range
            if ($minPrice = $request->query('min_price')) {
                $query->whereHas('product_variants', function($q) use ($minPrice) {
                    $q->where('unit_price', '>=', $minPrice);
                });
            }
    
            if ($maxPrice = $request->query('max_price')) {
                $query->whereHas('product_variants', function($q) use ($maxPrice) {
                    $q->where('unit_price', '<=', $maxPrice);
                });
            }
            $products = $query->get();
            if ($products->isEmpty()) {
                return $this->errorResponse(trans('messages.no_products_found'), 404);
            }
            return $this->successResponse(ProductResource::collection($products), trans('messages.products_found'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }

}

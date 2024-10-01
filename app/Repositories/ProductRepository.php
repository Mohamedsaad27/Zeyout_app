<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\HandleApiResponse;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;

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
    public function filterProducts($filterCriteria)
    {
        try {
            $query = Product::query();

            // Filter by category name in English
            if (!empty($filters['category_name_en'])) {
                $query->whereHas('category', function ($q) use ($filters) {
                    $q->where('name_en', $filters['category_name_en']);
                });
            }

            // Filter by brand name in English
            if (!empty($filters['brand_name_en'])) {
                $query->whereHas('brand', function ($q) use ($filters) {
                    $q->where('name_en', $filters['brand_name_en']);
                });
            }

            // Filter by size and mileage (from product variants)
            if (!empty($filters['size']) || !empty($filters['mileage'])) {
                $query->whereHas('product_variants', function ($q) use ($filters) {
                    if (!empty($filters['size'])) {
                        $q->where('size', $filters['size']);
                    }
                    if (!empty($filters['mileage'])) {
                        $q->where('mileage', $filters['mileage']);
                    }
                });
            }

            // Filter by API
            if (!empty($filters['API'])) {
                $query->where('API', $filters['API']);
            }

            // Filter by price range (from product variants)
            if (!empty($filters['min_price']) || !empty($filters['max_price'])) {
                $query->whereHas('product_variants', function ($q) use ($filters) {
                    if (!empty($filters['min_price'])) {
                        $q->where('unit_price', '>=', $filters['min_price']);
                    }
                    if (!empty($filters['max_price'])) {
                        $q->where('unit_price', '<=', $filters['max_price']);
                    }
                });
            }

            $products = $query->paginate(15);

            if ($products->isEmpty()) {
                return $this->errorResponse(trans('messages.no_products_found'), 404);
            }

            return $this->successResponse(ProductResource::collection($products), trans('messages.products_found'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }

}

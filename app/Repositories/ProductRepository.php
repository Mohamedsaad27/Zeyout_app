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
}

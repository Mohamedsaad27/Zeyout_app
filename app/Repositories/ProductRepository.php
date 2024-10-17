<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Governate;
use Illuminate\Http\Request;
use App\Traits\HandleApiResponse;
use App\Http\Resources\ProductResource;
use App\Http\Resources\GovernateResource;
use App\Http\Resources\SingleProductResource;
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
            $product = Product::with(['categories', 'brand', 'product_variants', 'favorites'])->find($productId);
            if(!$product){
                return $this->errorResponse(trans('messages.product_not_found'), 404);
            }
            return $this->successResponse(SingleProductResource::make($product), trans('messages.product_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function filterProducts(Request $request)
    {
        try {
            $products = Product::filter($request)->get();
            if($products->isEmpty()){
                return $this->errorResponse(trans('messages.no_products_found'), 404);
            }
            return $this->successResponse(ProductResource::collection($products), trans('messages.products_found'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function getRegions()
    {
        try {
           $governates = Governate::all();
           if($governates->isEmpty()){
            return $this->errorResponse(trans('messages.no_governates_found'), 404);
           }
            return $this->successResponse(GovernateResource::collection($governates), trans('messages.governates_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
}

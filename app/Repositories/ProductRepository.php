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
            $product = Product::with(['category', 'brand', 'product_variants', 'favorites'])->find($productId);
            if(!$product){
                return $this->errorResponse(trans('messages.product_not_found'), 404);
            }
            return $this->successResponse(ProductResource::make($product), trans('messages.product_retrieved'), 200);
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
            $regions = [
                ['id' => 1, 'name' => 'Cairo'],
                ['id' => 2, 'name' => 'Alexandria'],
                ['id' => 3, 'name' => 'Giza'],
                ['id' => 4, 'name' => 'Dakahlia'],
                ['id' => 5, 'name' => 'Sharkia'],
                ['id' => 6, 'name' => 'Qalyubia'],
                ['id' => 7, 'name' => 'Kafr El Sheikh'],
                ['id' => 8, 'name' => 'Gharbia'],
                ['id' => 9, 'name' => 'Monufia'],
                ['id' => 10, 'name' => 'Beheira'],
                ['id' => 11, 'name' => 'Ismailia'],
                ['id' => 12, 'name' => 'Suez'],
                ['id' => 13, 'name' => 'Port Said'],
                ['id' => 14, 'name' => 'Damietta'],
                ['id' => 15, 'name' => 'North Sinai'],
                ['id' => 16, 'name' => 'South Sinai'],
                ['id' => 17, 'name' => 'Matruh'],
                ['id' => 18, 'name' => 'New Valley'],
                ['id' => 19, 'name' => 'Faiyum'],
                ['id' => 20, 'name' => 'Beni Suef'],
                ['id' => 21, 'name' => 'Minya'],
                ['id' => 22, 'name' => 'Assyut'],
                ['id' => 23, 'name' => 'Sohag'],
                ['id' => 24, 'name' => 'Qena'],
                ['id' => 25, 'name' => 'Aswan'],
                ['id' => 26, 'name' => 'Luxor'],
                ['id' => 27, 'name' => 'Red Sea'],
            ];
            return $this->successResponse($regions, trans('messages.regions_retrieved'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
}

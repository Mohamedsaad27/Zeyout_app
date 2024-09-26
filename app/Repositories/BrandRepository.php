<?php

namespace App\Repositories;

use App\Http\Resources\BrandResource;
use App\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;
use App\Traits\HandleApiResponse;
use Illuminate\Container\Attributes\DB;

class BrandRepository implements BrandRepositoryInterface
{
    use HandleApiResponse;
    public function getAllBrands()
    {
        try {
            $brands = DB::table('brands')->get();
            if($brands->isEmpty()){
                return $this->errorResponse(trans('messages.no_brands'),404);
            }
            return $this->successResponse( BrandResource::collection($brands), trans('messages.brands_retrieved'));
        } catch (\Exception $e) {
           return $this->errorResponse($e->getMessage(),500);
        }
    }

    public function getBrandById($brandId)
    {
        try {
            $brand = Brand::find($brandId);
            return $this->successResponse( new BrandResource($brand), trans('messages.brand_retrieved'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(),500);
        }
    }
}
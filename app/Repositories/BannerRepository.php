<?php

namespace App\Repositories;

use App\Models\Banner;
use App\Traits\HandleApiResponse;
use App\Http\Resources\BannerResource;
use App\Interfaces\BannerRepositoryInterface;

class BannerRepository implements BannerRepositoryInterface
{
    use HandleApiResponse;
    public function index()
    {
        try {
            $banners = Banner::all();
            if($banners->isEmpty()){
                return $this->errorResponse('No banners found', 404);
            }
            return $this->successResponse(BannerResource::collection($banners), 'Banners retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve banners', 500);
        }
    }
}

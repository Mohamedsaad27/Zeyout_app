<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductVariantResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    
    public function toArray(Request $request)
{
    $isFavorite = $this->favorites()->where('user_id', auth()->id())->exists();
    $locale = $request->header('Accept-Language');
    
    $data = [
        'id' => $this->id,
        'name' => $locale == 'ar' ? $this->name_ar : $this->name_en,
        'description' => $locale == 'ar' ? $this->description_ar : $this->description_en,
        'image' => $this->image,
        'is_favorite' => $isFavorite,
        'product_variants' => ProductVariantResource::collection($this->product_variants),
        'categories' => $this->categories ? ($locale == 'ar' ? $this->categories->pluck('name_ar') : $this->categories->pluck('name_en')) : [],
        'brand' => $this->brand ? ($locale == 'ar' ? $this->brand->name_ar : $this->brand->name_en) : null,
        'API' => $this->API,
    ];

   
    return $data;
}

}

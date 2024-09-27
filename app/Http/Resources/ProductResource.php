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
        $isFavorite = Favorite::where('product_id', $this->id)
                        ->where('user_id', auth()->id())
                        ->exists();
        $locale = $request->header('Accept-Language');
        $data = [
            'id' => $this->id,
            'name' => $locale == 'ar' ? $this->name_ar : $this->name_en,
            'description' => $locale == 'ar' ? $this->description_ar : $this->description_en,
            'image' => $this->image,
            'is_favorite' => $isFavorite,
            'product_variants' => ProductVariantResource::collection($this->product_variants),
            'categories' => $locale == 'ar' ? $this->category->pluck('name_ar') : $this->category->pluck('name_en'),
            'brand' => $locale == 'ar' ? $this->brand->name_ar : $this->brand->name_en,
            'API' => $this->API,
        ];

        if ($request->route('id')) {
            $relatedProducts = $this->relatedProducts()->take(5)->get();
            $data['related_products'] = ProductResource::collection($relatedProducts);
        }

        return $data;
    }
}

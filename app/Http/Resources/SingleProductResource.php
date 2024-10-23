<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language');
        return [
            'id' => $this->id,
            'name' => $locale == 'ar' ? $this->name_ar : $this->name_en,
            'description' => $locale == 'ar' ? $this->description_ar : $this->description_en,
            'image' => $this->image,
            'is_favorite' => $this->favorites()->where('user_id', auth()->id())->exists(),
            'product_variants' => ProductVariantResource::collection($this->product_variants),
            'categories' => $this->categories ? ($locale == 'ar' ? $this->categories->pluck('name_ar') : $this->categories->pluck('name_en')) : [],
            'brand' => $this->brand ? ($locale == 'ar' ? $this->brand->name_ar : $this->brand->name_en) : null,
            'API' => $this->API,
            'related_products' => ProductResource::collection($this->relatedProducts),
        ];
    }
}

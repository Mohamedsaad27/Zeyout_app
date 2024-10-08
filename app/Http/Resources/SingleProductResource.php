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
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'is_favorite' => $this->favorites()->where('user_id', auth()->id())->exists(),
            'product_variants' => ProductVariantResource::collection($this->product_variants),
            'categories' => $this->category ? ($locale == 'ar' ? $this->category->pluck('name_ar') : $this->category->pluck('name_en')) : [],
            'brand' => $this->brand ? ($locale == 'ar' ? $this->brand->name_ar : $this->brand->name_en) : null,
            'API' => $this->API,
            'related_products' => ProductResource::collection($this->relatedProducts),
        ];
    }
}

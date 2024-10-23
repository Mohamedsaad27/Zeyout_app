<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleCategoryResource extends JsonResource
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
            'logo' => $this->logo,
            'products' => ProductResource::collection($this->products),
        ];
    }
}

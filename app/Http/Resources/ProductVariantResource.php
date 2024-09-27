<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'size' => $this->size,
            'mileage' => $this->mileage,
            'wholesale_price' => $this->wholesale_price,
            'unit_price' => $this->unit_price,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'logo' => asset($this->logo),
            'created_at' => $this->created_at,
        ];
    }
}

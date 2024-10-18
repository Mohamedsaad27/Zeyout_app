<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $locale = $request->header('Accept-Language');
        return [
            'id' => $this->id,
            'title' => $locale == 'ar' ? $this->title_ar ?? '' : $this->title_en ?? '',
            'description' => $locale == 'ar' ? $this->description_ar ?? '' : $this->description_en ?? '',
            'image' => $this->image,
        ];
    }
}

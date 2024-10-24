<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TraderResource extends JsonResource
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
            'id' => $this->user->id,
            'user_name' => $this->user->user_name,
            'email' => $this->user->email,
            'country' => $this->user->country,
            'phone_number' => $this->user->phone_number,
            'birth_date' => Carbon::parse($this->user->birth_date)->format('d-m-Y'),
            'profile_image' => $this->user->profile_image ? asset($this->user->profile_image) : null,
            'type' => $this->user->type,
            'description' => $locale == 'ar' ? $this->description_ar : $this->description_en,
            'governate' => $this->governate ? ($locale == 'ar' ? $this->governate->name_ar : $this->governate->name_en) : null,
            'FacebookURL' => $this->FacebookURL ?? null,
            'InstagramURL' => $this->InstagramURL ?? null,
       ];
    }
}

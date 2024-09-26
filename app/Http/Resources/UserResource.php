<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language');
        $data = [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'email' => $this->email,
            'country' => $this->country,
            'phone_number' => $this->phone_number,
            'birth_date' => Carbon::parse($this->birth_date)->format('d-m-Y'),
            'profile_image' => $this->profile_image,
            'type' => $this->type,
            'token' => $this->token,
        ];

        if ($this->type === 'trader' && $this->trader) {
            $data = array_merge($data, [
                'description' => $locale == 'ar' ? $this->trader->description_ar : $this->trader->description_en,
                'FacebookURL' => $this->trader->FacebookURL,
                'InstagramURL' => $this->trader->InstagramURL,
            ]);
        }

        return $data;
    }
}

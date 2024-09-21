<?php

namespace App\Http\Requests\Auth;

use App\Traits\HandleApiResponse;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    use HandleApiResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name_en' => 'required|string|max:255',
            'user_name_ar' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'country' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255|unique:users,phone_number',
            'birth_date' => 'required|date',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string|max:255|in:trader,consumer',
            'description_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'FacebookURL' => 'required|string|url|max:255',
            'InstagramURL' => 'required|string|url|max:255',
        ];
    }
    
}

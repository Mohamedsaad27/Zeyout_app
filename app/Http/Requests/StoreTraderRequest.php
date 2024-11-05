<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTraderRequest extends FormRequest
{
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
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'country' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255|url',
            'instagram_url' => 'nullable|string|max:255|url',
            'governate' => 'required|exists:governates,id',
            'number_of_days' => 'required|integer|min:1',
            'category' => 'required|exists:categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'user_name.required' => 'The user name is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'phone_number.required' => 'The phone number is required.',
            'profile_image.image' => 'The profile image must be an image.',
            'profile_image.mimes' => 'The profile image must be a valid image file.',
            'profile_image.max' => 'The profile image must be less than 2048 kilobytes.',
            'description_ar.string' => 'The description (Arabic) must be a string.',
            'description_en.string' => 'The description (English) must be a string.',
            'facebook_url.string' => 'The Facebook URL must be a string.',
            'instagram_url.string' => 'The Instagram URL must be a string.',
            'governate.required' => 'The governate is required.',
            'governate.exists' => 'The selected governate is invalid.',
            'facebook_url.url' => 'The Facebook URL must be a valid URL.',
            'instagram_url.url' => 'The Instagram URL must be a valid URL.',
            'number_of_days.required' => 'The number of days is required.',
            'number_of_days.integer' => 'The number of days must be an integer.',
            'number_of_days.min' => 'The number of days must be at least 1.',
            'category.required' => 'The category is required.',
            'category.exists' => 'The selected category is invalid.',
        ];
    }
}

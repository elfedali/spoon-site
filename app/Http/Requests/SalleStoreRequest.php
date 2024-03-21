<?php

namespace App\Http\Place;

use Illuminate\Foundation\Http\FormRequest;

class SalleStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'restaurant_id' => ['required', 'integer', 'exists:restaurants,id'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'capacity' => ['nullable', 'integer'],
        ];
    }
}

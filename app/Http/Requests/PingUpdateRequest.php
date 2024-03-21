<?php

namespace App\Http\Place;

use Illuminate\Foundation\Http\FormRequest;

class PingUpdateRequest extends FormRequest
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
            'place_id' => ['required', 'integer', 'exists:places,id'],
            'date_start' => ['required'],
            'date_end' => ['nullable'],
            'description' => ['nullable', 'string'],
        ];
    }
}

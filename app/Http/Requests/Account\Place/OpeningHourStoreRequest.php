<?php

namespace App\Http\Requests\Account\Place;

use Illuminate\Foundation\Http\FormRequest;

class OpeningHourStoreRequest extends FormRequest
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
            'day' => ['required', 'string'],
            'open' => ['nullable'],
            'close' => ['nullable'],
        ];
    }
}

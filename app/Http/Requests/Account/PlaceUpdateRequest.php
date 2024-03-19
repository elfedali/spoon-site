<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class PlaceUpdateRequest extends FormRequest
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
            'owner_id' => ['required', 'integer', 'exists:users,id'],
            'approver_id' => ['nullable', 'integer', 'exists:approvers,id'],
            'place_type' => ['required', 'in:restaurant,cafe,spa'],
            'street_id' => ['nullable', 'integer', 'exists:streets,id'],
            'title' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
            'phone_secondary' => ['nullable', 'string'],
            'phone_tertiary' => ['nullable', 'string'],
            'website' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'excerpt' => ['nullable', 'string'],
            'type_cuisine' => ['nullable', 'string'],
            'type_service' => ['nullable', 'string'],
            'type_amenity' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'reservation_required' => ['nullable', 'string'],
        ];
    }
}

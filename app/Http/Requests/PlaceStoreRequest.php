<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceStoreRequest extends FormRequest
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
            'owner_id' => ['nullable', 'integer', 'exists:users,id'], # TODO: remove nullable
            'approver_id' => ['nullable', 'integer', 'exists:approvers,id'],
            // 'place_type' => ['required', 'in:place,cafe,spa'],
            'place_service' => ['nullable', 'string'],
            'place_kitchen' => ['nullable', 'string'],
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
            'reservation_required' => ['required'],
        ];
    }
}

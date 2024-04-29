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
            'city' => ['required', 'string'],
            'neighborhood' => ['required', 'string'],
            'country' => ['nullable', 'string'],

            'email' => ['nullable', 'email'],
            'phone' => ['required', 'string'],
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

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le nom de restaurant est obligatoire',
            'address.required' => 'L\'adresse est obligatoire',
            'city.required' => 'La ville est obligatoire',
            'neighborhood.required' => 'Le quartier est obligatoire',
            'country.required' => 'Le pays est obligatoire',
            'phone.required' => 'Le numéro de téléphone est obligatoire',
            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères',
            'phone.regex' => 'Le numéro de téléphone doit être valide',
            'phone_secondary.string' => 'Le numéro de téléphone secondaire doit être une chaîne de caractères',
            'phone_secondary.regex' => 'Le numéro de téléphone secondaire doit être valide',
            'phone_tertiary.string' => 'Le numéro de téléphone tertiary doit être une chaîne de caractères',
            'phone_tertiary.regex' => 'Le numéro de téléphone tertiary doit être valide',
            'website.string' => 'Le site web doit être une chaîne de caractères',
            'website.regex' => 'Le site web doit être valide',
            'description.string' => 'La description doit être une chaîne de caractères',
            'type_cuisine.string' => 'Le type de cuisine doit être une chaîne de caractères',
            'type_service.string' => 'Le type de service doit être une chaîne de caractères',
            // Add other custom messages as needed
        ];
    }
}

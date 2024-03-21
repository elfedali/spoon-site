<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
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
            'table_id' => ['required', 'integer', 'exists:tables,id'],
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'approver_id' => ['nullable', 'integer', 'exists:approvers,id'],
            'arrival_date' => ['required'],
            'departure_date' => ['nullable'],
            'status' => ['required', 'in:pending,accepted,rejected'],
            'note' => ['nullable', 'string'],
        ];
    }
}

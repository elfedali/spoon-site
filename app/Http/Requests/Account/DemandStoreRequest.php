<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class DemandStoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'approver_id' => ['nullable', 'integer', 'exists:approvers,id'],
            'date_start' => ['required'],
            'date_end' => ['nullable'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
        ];
    }
}

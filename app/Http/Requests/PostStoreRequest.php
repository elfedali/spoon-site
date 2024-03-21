<?php

namespace App\Http;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            // 'author_id' => ['required', 'integer', 'exists:authors,id'],
            'status' => ['required', 'in:draft,published'],
        ];
    }
}

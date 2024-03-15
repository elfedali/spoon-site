<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentUpdateRequest extends FormRequest
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
            'uploader_id' => ['required', 'integer', 'exists:uploaders,id'],
            'title' => ['required', 'string'],
            'path' => ['required', 'string', 'unique:attachments,path'],
            'path_thumbnail' => ['nullable', 'string'],
            'path_medium' => ['nullable', 'string'],
            'path_large' => ['nullable', 'string'],
            'mime_type' => ['required', 'string'],
            'size' => ['required', 'integer'],
            'position' => ['required', 'integer'],
        ];
    }
}

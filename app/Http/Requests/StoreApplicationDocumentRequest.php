<?php

namespace App\Http\Requests;

use App\Models\ApplicationDocument;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', [ApplicationDocument::class, $this->route('job_application')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'document' => ['required', 'file', 'mimes:pdf,doc,docx,txt,jpg,jpeg,png', 'max:5120'],
        ];
    }
}

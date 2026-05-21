<?php

namespace App\Http\Requests;

use App\Models\Interview;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInterviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', [Interview::class, $this->route('job_application')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'max:255'],
            'scheduled_at' => ['required', 'date'],
            'preparation_notes' => ['nullable', 'string'],
            'result' => ['nullable', 'string'],
        ];
    }
}

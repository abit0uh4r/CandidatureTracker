<?php

namespace App\Http\Requests;

use App\Models\JobApplication;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('job_application'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'position_title' => ['required', 'string', 'max:255'],
            'offer_url' => ['nullable', 'url', 'max:255'],
            'status' => ['required', Rule::in(array_keys(JobApplication::STATUSES))],
            'priority' => ['required', Rule::in(array_keys(JobApplication::PRIORITIES))],
            'notes' => ['nullable', 'string'],
            'applied_at' => ['required', 'date'],
        ];
    }
}

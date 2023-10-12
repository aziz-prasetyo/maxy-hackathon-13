<?php

namespace App\Http\Requests\Admin;

use App\Models\Position;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreEmployeePositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user('api')?->role->isAdministrator();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'position_name' => ['required', 'string', 'max:255', 'unique:'.Position::class],
            'slug' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'position_name' => 'position name',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->position_name)
        ]);
    }
}

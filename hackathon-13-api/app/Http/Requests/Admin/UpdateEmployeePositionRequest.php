<?php

namespace App\Http\Requests\Admin;

use App\Models\Position;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateEmployeePositionRequest extends FormRequest
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
            'position_name' => ['required', 'string', 'max:255'],
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
     * Configure the validator instance.
     *
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        
        $validator->after(function ($validator) {
            $data = $validator->getData();
            $position = Position::findOrFail($this->route('position'))->first();

            if ($this->position_name === $position->position_name && $this->description === $position->description) {
                $validator->errors()->add('no_changes', 'There are no changes to the data.');
            }

            if ($this->position_name !== $position->position_name) {
                $existingSlug = Position::where('slug', $data['slug'])->first();

                if ($existingSlug) {
                    $validator->errors()->add('position_name', 'The position name results in a duplicate slug.');
                }
            }
        });
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

<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\EmployeePosition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreEmployeeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'min:18', 'max:18', 'unique:'.EmployeeDetail::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'position_id' => ['required', 'unique:'.EmployeePosition::class],
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
            'nip' => 'NIP',
            'position_id' => 'position',
        ];
    }
}

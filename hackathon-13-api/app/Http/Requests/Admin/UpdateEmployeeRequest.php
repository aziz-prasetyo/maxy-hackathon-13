<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRoleName;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Validator;

class UpdateEmployeeRequest extends FormRequest
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
        $employeeId = $this->route('employee');

        return [
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'min:18', 'max:18', Rule::unique('employee_details')->ignore($employeeId, 'employee')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($employeeId)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'position_id' => ['required', Rule::unique('employee_positions')->ignore($employeeId, 'employee')],
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

    /**
     * Configure the validator instance.
     *
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        
        $validator->after(function ($validator) {
            $data = $validator->getData();
            $employee = User::with(['userDetail', 'employeeDetail', 'positions'])
                ->where('role', UserRoleName::EMPLOYEE)
                ->findOrFail($this->route('employee'));

            if ($this->name === $employee->name && $this->nip === $employee->employeeDetail->nip && $this->email === $employee->email && Hash::check($this->password, $employee->password) && $this->position_id === $employee->positions->first()->id) {
                $validator->errors()->add('no_changes', 'There are no changes to the data.');
            }
        });
    }
}

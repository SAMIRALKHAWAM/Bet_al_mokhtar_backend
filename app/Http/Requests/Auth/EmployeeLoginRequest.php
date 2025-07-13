<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeLoginRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => [Rule::exists('employees', 'user_name')->whereNull('deleted_at'), 'required'],
            'password' => 'string|min:8|nullable',
        ];
    }

    public function messages()
    {
        return [
            'password.min' => 'the password at least 8 character'
        ];
    }
}

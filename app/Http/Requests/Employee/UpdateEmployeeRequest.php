<?php

namespace App\Http\Requests\Employee;

use App\Enum\EmployeeTypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [Rule::exists('employees','id')->whereNull('deleted_at'),'required'],
            'branch_id' => [Rule::exists('branches', 'id')->whereNull('deleted_at'), 'required'],
            'name' => 'required',
            'user_name' => [Rule::unique('employees')->whereNull('deleted_at')->ignore($this->id),'required'],
            'password' => 'string|min:8|nullable',
            'type' => [Rule::in(EmployeeTypeEnum::toArray()), 'required'],
            'phone' => [Rule::unique('employees')->whereNull('deleted_at')->ignore($this->id),'required','phone:sy'],
            'address' => 'required',
            'age' => 'required|integer|between:15,60',
            'skill' => 'required',
            'last_job' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'password.min' => 'the password at least 8 character'
        ];
    }
}

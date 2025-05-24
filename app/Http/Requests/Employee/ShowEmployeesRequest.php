<?php

namespace App\Http\Requests\Employee;

use App\Enum\EmployeeTypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowEmployeesRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable',
            'type' => [Rule::in(EmployeeTypeEnum::toArray()),'nullable'],
            'branchId' => [Rule::exists('branches','id')->whereNull('deleted_at'),'nullable'],
        ];
    }
}

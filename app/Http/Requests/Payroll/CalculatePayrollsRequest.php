<?php

namespace App\Http\Requests\Payroll;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CalculatePayrollsRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'excel' => ['required','file','mimes:xlsx','max:10240'],
        ];
    }
}

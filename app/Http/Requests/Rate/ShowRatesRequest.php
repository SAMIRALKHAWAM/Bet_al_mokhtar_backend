<?php

namespace App\Http\Requests\Rate;

use App\Http\Requests\BaseRequest;
use App\Services\BaseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowRatesRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rate' => 'nullable|numeric|min:1|max:5',
            'userId' => [Rule::exists('users','id'),'nullable'],
            'branchId' => [Rule::exists('branches','id')->whereNull('deleted_at'),'nullable'],
        ];
    }

    public function messages()
    {
        return [
            'rate.min' => 'the rate between 1 and 5',
        ];
    }
}

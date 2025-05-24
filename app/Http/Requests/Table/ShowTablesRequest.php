<?php

namespace App\Http\Requests\Table;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowTablesRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branchId' => [Rule::exists('branches', 'id')->whereNull('deleted_at'), 'nullable'],
            'available' => 'boolean|nullable',
        ];
    }
}

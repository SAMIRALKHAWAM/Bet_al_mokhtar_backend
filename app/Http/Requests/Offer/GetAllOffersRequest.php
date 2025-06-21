<?php

namespace App\Http\Requests\Offer;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetAllOffersRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string',
            'branchId' => [Rule::exists('branches','id')->whereNull('deleted_at'),'nullable'],
            'active' => [Rule::in([0,1]),'nullable'],
        ];
    }
}

<?php

namespace App\Http\Requests\PurchaseInvoice;

use App\Enum\EmployeeTypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePurchaseInvoiceRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branch_id' => [Rule::exists('branches', 'id')->whereNull('deleted_at'), 'required'],
            'accountant_id' => [Rule::exists('employees', 'id')->whereNull('deleted_at')->where('type', EmployeeTypeEnum::ACCOUNTANT)->where('branch_id', $this->branch_id), 'required'],
            'materials' => 'array|required',
            'materials.*.material_id' => [
                Rule::exists('materials', 'id')
                    ->whereNull('deleted_at'),
                'required',
                'distinct',
            ],
            'materials.*.quantity' => 'integer|min:1|required',
            'materials.*.price' => 'integer|min:1|required',
        ];
    }
}

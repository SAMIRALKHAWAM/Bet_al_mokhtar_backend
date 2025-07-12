<?php

namespace App\Http\Requests\Invoice;

use App\Enum\OrderStatusEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowInvoicesRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branchId' => [Rule::exists('branches','id')->whereNull('deleted_at'),'nullable'],
            'status' => [Rule::in(OrderStatusEnum::InvoiceStatus()),'nullable'],
        ];
    }
}

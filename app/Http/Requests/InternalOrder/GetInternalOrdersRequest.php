<?php

namespace App\Http\Requests\InternalOrder;

use App\Enum\OrderStatusEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetInternalOrdersRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => [Rule::in(OrderStatusEnum::InternalOrderStatus()),'nullable'],
        ];
    }
}

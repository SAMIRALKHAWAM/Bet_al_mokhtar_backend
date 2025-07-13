<?php

namespace App\Http\Requests\ExternalOrder;

use App\Enum\OrderStatusEnum;
use App\Enum\OrderTypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AcceptExternalOrderRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [Rule::exists('internal_orders','id')->where('status',OrderStatusEnum::DELIVERING)->where('type',OrderTypeEnum::EXT),'required'],
            'user_id' =>[Rule::exists('users','id'),'required'],
        ];
    }
}

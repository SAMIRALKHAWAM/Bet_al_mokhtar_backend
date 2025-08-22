<?php

namespace App\Http\Requests\ExternalOrder;

use App\Enum\EmployeeTypeEnum;
use App\Enum\OrderStatusEnum;
use App\Enum\OrderTypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeExternalOrderStatusRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $arr = [
            'branch_id' => [Rule::exists('branches', 'id')->whereNull('deleted_at'), 'required'],
            'status' => [Rule::in(OrderStatusEnum::InternalOrderStatus()), 'required'],
        ];

     if ($this->status == OrderStatusEnum::PREPARING) {
            $arr['id'] = [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) {
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $this->branch_id);
                    })
                    ->where('status', OrderStatusEnum::WAITING)
                    ->where('type',OrderTypeEnum::EXT),
            ];
            $arr['captain_id'] = [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::CAPTAIN), 'required'];
        } elseif ($this->status == OrderStatusEnum::DELIVERING) {
            $arr['id'] = [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) {
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $this->branch_id);
                    })
                    ->where('status', OrderStatusEnum::PREPARING)
                    ->where('type',OrderTypeEnum::EXT),
            ];
            $arr['captain_id'] = [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::CAPTAIN), 'required'];
            $arr['deliveryman_id'] =    [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::DELIVERYMAN), 'required'];
     }

        return $arr;
    }


}

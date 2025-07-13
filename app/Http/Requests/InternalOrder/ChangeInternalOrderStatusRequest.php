<?php

namespace App\Http\Requests\InternalOrder;

use App\Enum\EmployeeTypeEnum;
use App\Enum\OrderStatusEnum;
use App\Enum\OrderTypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeInternalOrderStatusRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $arr = [
            'table_id' => [Rule::exists('tables', 'id')->where('branch_id', $this->branch_id)->where('available', 0)->whereNull('deleted_at'), 'required'],
            'branch_id' => [Rule::exists('branches', 'id')->whereNull('deleted_at'), 'required'],
            'status' => [Rule::in(OrderStatusEnum::InternalOrderStatus()),'required'],
        ];

        if ($this->status == OrderStatusEnum::PENDING){
            $arr['id'] =  [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) {
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $this->branch_id)
                            ->where('table_id', $this->table_id);
                    })
                    ->where('status', OrderStatusEnum::WAITING)
                    ->where('type',OrderTypeEnum::INT),
            ];
            $arr['waiter_id'] = [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::WAITER), 'required'];
        }
        elseif ($this->status == OrderStatusEnum::WAITING){
            $arr['id'] =  [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) {
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $this->branch_id)
                            ->where('table_id', $this->table_id);
                    })
                    ->where('status', OrderStatusEnum::PENDING)
                    ->where('type',OrderTypeEnum::INT),
            ];
            $arr['waiter_id'] = [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::WAITER), 'required'];
        }
        elseif ($this->status == OrderStatusEnum::PREPARING){
            $arr['id'] =  [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) {
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $this->branch_id)
                            ->where('table_id', $this->table_id);
                    })
                    ->where('status', OrderStatusEnum::WAITING)
                    ->where('type',OrderTypeEnum::INT),
            ];   $arr['captain_id'] = [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::CAPTAIN), 'required'];
        }
        elseif ($this->status == OrderStatusEnum::FINISHING){
            $arr['id'] =  [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) {
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $this->branch_id)
                            ->where('table_id', $this->table_id);
                    })
                    ->where('status', OrderStatusEnum::PREPARING)
                    ->where('type',OrderTypeEnum::INT),
            ];
            $arr['captain_id'] = [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::CAPTAIN), 'required'];
        }

        return $arr;
    }
}

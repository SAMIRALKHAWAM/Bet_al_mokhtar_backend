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
            'status' => [Rule::in(OrderStatusEnum::InternalOrderStatus()),'required'],
        ];

        if ($this->status == OrderStatusEnum::PENDING){
            $waiter = \auth('Employee')->user();
            $branch_id = $waiter->Branch?->id;
            $arr['table_id'] = [Rule::exists('tables', 'id')->where('branch_id', $branch_id)->where('available', 0)->whereNull('deleted_at'), 'required'];
            $arr['id'] =  [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) use ($branch_id) {
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $branch_id)
                            ->where('table_id', $this->table_id);
                    })
                    ->where('status', OrderStatusEnum::WAITING)
                    ->where('type',OrderTypeEnum::INT),
            ];
          }
        elseif ($this->status == OrderStatusEnum::PREPARING){
            $captain = \auth('Employee')->user();
            $branch_id = $captain->Branch?->id;
            $arr['table_id'] = [Rule::exists('tables', 'id')->where('branch_id', $branch_id)->where('available', 0)->whereNull('deleted_at'), 'required'];
            $arr['id'] =  [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) use ($branch_id){
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $branch_id)
                            ->where('table_id', $this->table_id);
                    })
                    ->where('status', OrderStatusEnum::WAITING)
                    ->where('type',OrderTypeEnum::INT),
            ];
        }
        elseif ($this->status == OrderStatusEnum::FINISHING){
            $captain = \auth('Employee')->user();
            $branch_id = $captain->Branch?->id;
            $arr['table_id'] = [Rule::exists('tables', 'id')->where('branch_id', $branch_id)->where('available', 0)->whereNull('deleted_at'), 'required'];
            $arr['id'] =  [
                'required',
                Rule::exists('internal_orders', 'id')
                    ->whereNull('deleted_at')
                    ->whereIn('invoice_id', function ($query) use($branch_id){
                        $query->select('id')
                            ->from('invoices')
                            ->where('branch_id', $branch_id)
                            ->where('table_id', $this->table_id);
                    })
                    ->where('status', OrderStatusEnum::PREPARING)
                    ->where('type',OrderTypeEnum::INT),
            ];
        }

        return $arr;
    }
}

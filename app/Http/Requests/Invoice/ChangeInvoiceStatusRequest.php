<?php

namespace App\Http\Requests\Invoice;

use App\Enum\EmployeeTypeEnum;
use App\Enum\OrderStatusEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ChangeInvoiceStatusRequest extends BaseRequest
{

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $invoiceId = $this->input('id');

            if (!$invoiceId) return;

            $internalOrders = DB::table('internal_orders')
                ->where('invoice_id', $invoiceId)
                ->whereNull('deleted_at')
                ->pluck('status');


            if ($internalOrders->isEmpty() || $internalOrders->contains(fn($status) => $status !== OrderStatusEnum::FINISHING)) {
                $validator->errors()->add('id', 'All internal orders under this invoice must have status FINISHING.');
            }
        });
    }

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
            'status' => [Rule::in(OrderStatusEnum::InvoiceStatus()), 'required'],
        ];


        if ($this->status == OrderStatusEnum::CHECKOUT) {
            $arr['id'] = [
                'required',
                Rule::exists('invoices', 'id')
                    ->where('branch_id', $this->branch_id)
                    ->where('table_id', $this->table_id)
                    ->where('status', OrderStatusEnum::PENDING),
            ];
            $arr['waiter_id'] = [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::WAITER), 'required'];
        } elseif ($this->status == OrderStatusEnum::DONE) {
            $arr['id'] = [
                'required',
                Rule::exists('invoices', 'id')
                    ->where('branch_id', $this->branch_id)
                    ->where('table_id', $this->table_id)
                    ->where('status', OrderStatusEnum::CHECKOUT),
            ];
            $arr['cashier_id'] = [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', EmployeeTypeEnum::CASHIER), 'required'];
            $arr['discount'] = ['integer','required','min:0','max:5000'];
            $arr['discount_id'] = [Rule::exists('discounts','id')->whereNull('deleted_at')->where(function ($query) {
                    $query->where('from_date', '<=', \now())
                    ->where('to_date', '>=', \now());
            }),'nullable'];
        }

        return $arr;
    }
}

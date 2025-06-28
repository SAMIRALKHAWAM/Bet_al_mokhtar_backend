<?php

namespace App\Http\Requests\Table;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableChangeStatusRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [Rule::exists('tables', 'id')->where('branch_id', $this->branch_id)->where('available', 1)->whereNull('deleted_at'), 'required'],
            'branch_id' => [Rule::exists('branches', 'id')->whereNull('deleted_at'), 'required'],
            'waiter_id' => [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', 'waiter'), 'required'],
        ];
    }
}

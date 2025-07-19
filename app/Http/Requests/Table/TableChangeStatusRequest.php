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

        $waiter = \auth('Employee')->user();
        $branch_id = $waiter->Branch?->id;
        return [
            'id' => [Rule::exists('tables', 'id')->where('branch_id', $branch_id)->where('available', 1)->whereNull('deleted_at'), 'required'],
        ];
    }
}

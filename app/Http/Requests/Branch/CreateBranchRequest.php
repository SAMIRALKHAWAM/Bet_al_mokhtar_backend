<?php

namespace App\Http\Requests\Branch;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBranchRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sub_admin_id' => [
                'required',
                Rule::exists('admins', 'id')
                    ->whereNull('deleted_at')
                    ->where('type', 'subadmin'),
                Rule::unique('branches', 'sub_admin_id')
                    ->whereNull('deleted_at'),
            ],

            'name' => [Rule::unique('branches')->whereNull('deleted_at'), 'required'],
            'location' => 'required',
        ];
    }
}

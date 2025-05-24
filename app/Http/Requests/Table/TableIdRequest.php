<?php

namespace App\Http\Requests\Table;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TableIdRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (\request()->route()->getName() === 'delete_table'){
            return [
                'id' => [Rule::exists('tables','id')->whereNull('deleted_at')->where('available',1),'required'],
            ];
        }
        return [
            'id' => [Rule::exists('tables','id')->whereNull('deleted_at'),'required'],
        ];
    }
}

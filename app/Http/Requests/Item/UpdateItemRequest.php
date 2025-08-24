<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [Rule::exists('items')->whereNull('deleted_at'),'required'],
            'category_id' => [Rule::exists('categories','id')->whereNull('deleted_at'),'required'],
            'name' => [Rule::unique('items')->whereNull('deleted_at')->ignore($this->id),'required'],
            'description' => 'required|string',
            'price' => 'required|min:1000|numeric',
        ];
    }
}

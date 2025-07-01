<?php

namespace App\Http\Requests\Material;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMaterialRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [Rule::exists('materials','id')->whereNull('deleted_at'),'required'],
            'name' => [Rule::unique('materials')->whereNull('deleted_at')->ignore($this->id),'required'],
            'unit' => 'required|string',
            'price' => 'nullable|integer|min:1',
        ];
    }
}

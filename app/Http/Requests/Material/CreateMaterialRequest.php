<?php

namespace App\Http\Requests\Material;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMaterialRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [Rule::unique('materials')->whereNull('deleted_at'),'required'],
            'unit' => 'required|string',
            'price' => 'nullable|integer|min:1',
        ];
    }
}

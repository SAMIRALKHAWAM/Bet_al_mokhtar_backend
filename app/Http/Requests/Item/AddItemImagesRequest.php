<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddItemImagesRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [Rule::exists('items','id')->whereNull('deleted_at'),'required'],
            'images' => 'required|array',
            'images.*' => 'required|image',
        ];
    }
}

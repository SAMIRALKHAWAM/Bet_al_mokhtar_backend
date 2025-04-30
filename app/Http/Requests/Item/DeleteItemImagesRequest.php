<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteItemImagesRequest extends BaseRequest
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
            'images' => 'required',
            'images.*' => [Rule::exists('item_images','id')->whereNull('deleted_at')->where('item_id',$this->id),'required','distinct'],
        ];
    }
}

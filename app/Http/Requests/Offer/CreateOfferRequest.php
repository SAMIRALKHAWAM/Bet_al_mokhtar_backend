<?php

namespace App\Http\Requests\Offer;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOfferRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branches' => 'array|required',
            'branches.*' => [Rule::exists('branches', 'id')->whereNull('deleted_at'), 'required', 'distinct'],
            'name' => [Rule::unique('offers')->whereNull('deleted_at'), 'required', 'string'],
            'description' => 'required',
            'items' => 'array|required',
            'items.*.item_id' => [
                Rule::exists('items', 'id')
                    ->whereNull('deleted_at'),
                'required',
                'distinct',
            ],
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric',
            'from_date' => ['required', 'date', 'after_or_equal:today'],
            'to_date' => ['required', 'date', 'after:from_date'],
        ];


    }
}

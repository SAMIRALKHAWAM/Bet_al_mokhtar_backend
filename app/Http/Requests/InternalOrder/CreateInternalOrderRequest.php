<?php

namespace App\Http\Requests\InternalOrder;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateInternalOrderRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'branch_id' => [Rule::exists('branches', 'id')->whereNull('deleted_at'), 'required'],
            'table_id' => [Rule::exists('tables', 'id')->where('branch_id', $this->branch_id)->whereNull('deleted_at')->where('available',0), 'required'],
            'waiter_id' => [Rule::exists('employees', 'id')->where('branch_id', $this->branch_id)->where('type', 'waiter'), 'required'],
            'items' => 'array',
            'items.*.item_id' => [
                Rule::exists('items', 'id')
                    ->whereNull('deleted_at'),
                'required_with:items',
                'distinct',
            ],
            'items.*.quantity' => 'integer|min:1|required_with:items',
            'offers' => 'array',
            'offers.*.offer_id' => [
                Rule::exists('offers', 'id')
                    ->whereNull('deleted_at')
                    ->where(function ($query) {
                        $query->where('available', 1)
                            ->where('from_date', '<=', \now())
                            ->where('to_date', '>=', \now());
                    })
                    ->whereIn('id', function ($query) {
                        $query->select('offer_id')
                            ->from('offer_branches')
                            ->where('branch_id', $this->branch_id);
                    }),
                'required_with:offers',
                'distinct',
            ],
            'offers.*.quantity' => 'integer|min:1|required_with:offers',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $items = $this->input('items');
            $offers = $this->input('offers');

            $itemsEmpty = empty($items);
            $offersEmpty = empty($offers);

            if ($itemsEmpty && $offersEmpty) {
                $validator->errors()->add('items', 'At least one of items or offers must be provided.');
                $validator->errors()->add('offers', 'At least one of items or offers must be provided.');
            }
        });
    }

}

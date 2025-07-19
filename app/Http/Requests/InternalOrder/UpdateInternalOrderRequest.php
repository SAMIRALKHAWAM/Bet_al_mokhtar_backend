<?php

namespace App\Http\Requests\InternalOrder;

use App\Enum\OrderStatusEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInternalOrderRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $waiter = \auth('Employee')->user();
        $branch_id = $waiter->branch_id;
        return [
            'id' => [Rule::exists('internal_orders','id')->where('status',OrderStatusEnum::PENDING),'required'],
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
                    ->whereIn('id', function ($query) use ($branch_id){
                        $query->select('offer_id')
                            ->from('offer_branches')
                            ->where('branch_id', $branch_id);
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

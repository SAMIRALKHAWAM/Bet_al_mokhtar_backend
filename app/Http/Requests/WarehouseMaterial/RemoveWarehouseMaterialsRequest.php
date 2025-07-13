<?php

namespace App\Http\Requests\WarehouseMaterial;

use App\Enum\EmployeeTypeEnum;
use App\Http\Requests\BaseRequest;
use App\Models\Material;
use App\Models\WarehouseMaterial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RemoveWarehouseMaterialsRequest extends BaseRequest
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
            'warehouseman_id' => [Rule::exists('employees', 'id')->whereNull('deleted_at')
                ->where('type', EmployeeTypeEnum::WAREHOUSEMAN)->where('branch_id', $this->branch_id), 'required'],
            'materials' => 'array|required',
            'materials.*.material_id' => [
                Rule::exists('materials', 'id')
                    ->whereNull('deleted_at'),
                'required',
                'distinct',
            ],
            'materials.*.quantity' => 'integer|min:1|required',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach ($this->input('materials', []) as $index => $materialData) {
                $materialId = $materialData['material_id'] ?? null;
                $requestedQty = $materialData['quantity'] ?? null;

                if ($materialId && $requestedQty && $this->branch_id) {
                    $warehouseMaterial = \App\Models\WarehouseMaterial::where('material_id', $materialId)
                        ->whereHas('warehouse', function ($query) {
                            $query->where('branch_id', $this->branch_id);
                        })
                        ->with('warehouse')
                        ->first();

                    $availableQty = $warehouseMaterial?->quantity ?? 0;

                    if ($requestedQty > $availableQty) {
                        $validator->errors()->add(
                            "materials.$index.quantity",
                            "The requested quantity ($requestedQty) exceeds available stock ($availableQty) in the branch's warehouse."
                        );
                    }
                }
            }
        });
    }
}

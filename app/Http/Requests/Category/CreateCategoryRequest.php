<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;
use App\Services\BaseService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [Rule::unique('categories')->whereNull('deleted_at'), 'required'],
            'image' => 'required|image',
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $arr = [
            'password' => 'string|min:8|nullable',
        ];


        if (\request()->route()->getName() === 'employee_login'){
            $arr['user_name'] = [Rule::exists('employees', 'user_name')->whereNull('deleted_at'), 'required'];
        }
        elseif (\request()->route()->getName() === 'admin_login'){
            $arr['user_name'] = [Rule::exists('admins', 'user_name')->whereNull('deleted_at'), 'required'];
        }else{
            $arr['user_name'] = [Rule::exists('users', 'user_name'), 'required'];
        }

        return $arr;
    }

    public function messages()
    {
        return [
            'password.min' => 'the password at least 8 character'
        ];
    }
}

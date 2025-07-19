<?php

namespace App\Services\Auth;

use App\Exceptions\ValidationException;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{


    public function Login($arr)
    {
        if (\request()->route()->getName() === 'employee_login'){
            $actor = Employee::where('user_name', $arr['user_name'])->first();
        }
        elseif (\request()->route()->getName() === 'admin_login'){
            $actor = Admin::where('user_name', $arr['user_name'])->first();
        }else{
            $actor = User::where('user_name', $arr['user_name'])->first();
        }
        if (!Hash::check($arr['password'], $actor->password)) {
            throw new ValidationException('the password incorrect');
        }
        $actor->tokens()->delete();
        $token = $actor->createToken('authToken', ['Employee'])->accessToken;
        $actor['token'] = $token;
        return $actor;
    }

    public function Logout()
    {

        if (\request()->route()->getName() === 'employee_logout') {
            $actor = \auth('Employee')->user();
        } elseif (\request()->route()->getName() === 'admin_logout') {
            $actor = \auth('Admin')->user();
        } else {
            $actor = \auth('User')->user();
        }

        $actor->tokens()->delete();
    }
}




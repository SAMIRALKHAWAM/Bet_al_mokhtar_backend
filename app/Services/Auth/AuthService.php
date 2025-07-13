<?php

namespace App\Services\Auth;

use App\Exceptions\ValidationException;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class AuthService
{


    public function EmployeeLogin($arr){
        $employee = Employee::where('user_name', $arr['user_name'])->first();
        if (!Hash::check($arr['password'], $employee->password)) {
            throw new ValidationException('the password incorrect');
        }
        $employee->tokens()->delete();
        $token = $employee->createToken('authToken', ['Employee'])->accessToken;
        $employee['token'] = $token;
        return $employee;
    }

    public function EmployeeLogout(){
        $employee = \auth('Employee')->user();
        $employee->tokens()->delete();
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ValidationException;
use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EmployeeLoginRequest;
use App\Models\Employee;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseCRUDController
{
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function EmployeeLogin(EmployeeLoginRequest $request)
    {
        $arr = Arr::only($request->validated(), ['user_name', 'password']);
        $employee = $this->service->EmployeeLogin($arr);
        return $this->sendResponse(__('custom.Success'), $employee);
    }

    public function EmployeeLogout()
    {
        $this->service->EmployeeLogout();
        return $this->sendResponse(__('custom.Success'));
    }
}

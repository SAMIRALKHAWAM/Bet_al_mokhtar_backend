<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ValidationException;
use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

    public function Login(LoginRequest $request)
    {
        $arr = Arr::only($request->validated(), ['user_name', 'password','model']);
        $actor = $this->service->Login($arr);
        return $this->sendResponse(__('custom.Success'), $actor);
    }

    public function Logout()
    {
        $this->service->Logout();
        return $this->sendResponse(__('custom.Success'));
    }
}

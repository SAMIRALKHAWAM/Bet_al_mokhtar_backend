<?php

namespace App\Http\Controllers\Payroll;


use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payroll\CalculatePayrollsRequest;
use App\Services\Payroll\PayrollService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class PayrollController extends BaseCRUDController
{


    public function __construct(PayrollService $service)
    {
        $this->service = $service;
    }


    public function CalculatePayrolls(CalculatePayrollsRequest $request){
        $data = Arr::only($request->validated(),['excel']);
        try {
        $file   = $data['excel'];
        $result = $this->service->calculateFromUploadedFile($file);

      return $this->sendResponse('Calculate Successfully',$result);
    } catch (\Throwable $e) {
           throw ValidationException::withMessages(['Calculate Failed']);

    }
}
}

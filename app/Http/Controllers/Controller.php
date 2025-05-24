<?php

namespace App\Http\Controllers;

use App\Exceptions\BaseException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function sendResponse($message,  $data = [],$code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }

    protected function sendError($message, $code = 400)
    {
        $response = [
            'error' => $message,
        ];

        return response()->json($response, $code);
    }

    protected function sendPagination($message,  $data = [],$code = 200)
    {
        $response = [
            'success' => true,
            'message' => 'Found Successfully',
            'per_page' => $data['per_page'],
            'total' => $data['total'],
            'current_page' => $data['current_page'],
            'last_page' => $data['last_page'],
            'data' => $data['data'],
        ];
        return response()->json($response, $code);
    }
}

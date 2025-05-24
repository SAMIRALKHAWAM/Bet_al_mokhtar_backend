<?php

namespace App\Http\Controllers;

use App\Exceptions\BaseException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class BaseCRUDController extends Controller
{

    protected $service;
    protected $createRequest;
    protected $updateRequest;
    protected $idRequest;


    protected function index()
    {
        $res = $this->service->getAll();
        return $this->sendResponse(__('custom.Success'), $res);
    }

    protected function indexPagination()
    {
        $res = $this->service->getAllPagination();
        $perPage = \request()->header('perPage',10);
        if ($perPage === '*'){
            return $this->sendResponse(__('custom.Success'), $res);
        }
        return $this->sendPagination(__('custom.Success'), $res);
    }

    protected function get_one($id)
    {
        $data = app($this->idRequest)->validated();
        $res = $this->service->getOne($id);
        return $this->sendResponse(__('custom.Success'), $res);
    }

    protected function store(Request $request)
    {
        $data = app($this->createRequest)->validated();
        $res = $this->service->create($data);
        return $this->sendResponse(__('custom.Success'), $res);
    }

    protected function update(Request $request, $id)
    {
        $data = app($this->updateRequest)->validated();
        $res = $this->service->update($id, $data);
        return $this->sendResponse(__('custom.Success'), $res);
    }

    protected function destroy($id)
    {
        $data = app($this->idRequest)->validated();
        $this->service->delete($id);
        return $this->sendResponse(__('custom.Success'));
    }
}

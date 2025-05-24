<?php

namespace App\Services;


use App\Exceptions\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class BaseService
{
    protected $model;

    public function getAll($where = [])
    {
        return $this->model::where($where)->get();
    }

    /** @noinspection PhpUnused */
    public function getAllPagination($where = []){
        $perPage = \request()->header('perPage',10);
        if ($perPage === '*'){
            return $this->getAll($where);
        }
        return $this->model::where($where)->paginate($perPage)->toArray();
    }

    public function getOne($id)
    {
        $object = $this->model::find($id);
        return $object;
    }

    public function create($data)
    {
        return $this->model::create($data);
    }

    public function update($id, $data)
    {
        $object = $this->model::find($id);
        $object->update($data);
        return $object;
    }

    public function delete($id)
    {
        $object = $this->model::find($id);
        return $object->delete();
    }
}

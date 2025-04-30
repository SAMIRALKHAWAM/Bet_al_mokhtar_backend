<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /* Now we have all the functions wich in the base service.
       You can override any function based on your requirements 

    public function create($data)
    {
        //Some aditional operations
        return User::create($data);
    }

    */


    /* For each possible error we could face ,
       we have to make a custom exception class to handle it.
       So you will throw this exception here and handle it in the render function for each exception class.

    public function exampleFunction($data)
    {
        Some operations
        .
        .
        .
        if(some condition)
        {
            throw new SomeException() ;

            or if you have a custom error message 

            throw new SomeException('The message') ; 
        }
        .
        .
        .
        Some operations
    }

    */


    /* 
    // If we have to return a large json , we can use Resource instead of creating the json in the service

    public function getOne($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new NotFoundException();
        }

        // Instead of doing this

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at, 
        ];

        // We can do this

        return new UserResource($user);
    }

    */
}

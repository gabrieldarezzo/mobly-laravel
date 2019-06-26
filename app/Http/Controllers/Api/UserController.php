<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends ApiController
{

    /**
     * Display a listing of the users, user/{id}. (4.a | 4.b)
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $model)
    {
        $this->model = $model;        
    }

    /**
     * Display a listing of the posts. (4.c)
     *
     * @return \Illuminate\Http\Response
     */
    public function posts($id)
    {
        return User::find($id)->posts;
    }
}

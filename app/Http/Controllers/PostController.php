<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }
}

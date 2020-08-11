<?php

namespace App\Rest\version\v2;

use App\Rest\version\v1\UserController as V1UserController;

class UserController extends V1UserController
{
    //
    public function __construct()
    {
        parent::__construct();
    }
}

<?php

namespace App\Rest\version\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    private $loggedUser;
    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->loggedUser = auth()->guard('api')->user();
            return $next($request);
        });
    }

    /**
     * @return mixed
     */
    public function auth()
    {
        return $this->loggedUser;
    }
}

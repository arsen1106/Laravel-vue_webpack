<?php

namespace App\Http\Controllers;

use App\Jobs\WriteSocialUserCredentials;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Home;

class HomeController extends Controller
{
    public $home;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->home = new Home();
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function  test()
    {
        $user = SocialAccount::with('user')
            ->where(['token'=>'ya29.a0AfH6SMA-L6TMo03858LxsVy3LxJaMXY1C6hi7ORY8kDYip6drq0aVUemO11QJr6ywgzu1ofqbI3B2z5f9VHj1TEvOaE7ofgKDyww_eXxMmn6oswczEtHBosvhTHamphzcL82_C4pscYI9GNIYaC4yjxDfSgMSOKdMXk'])
            ->first();
        return response()->json($user);
    }
}

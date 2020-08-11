<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    //
    protected $table = 'home';

    public function links(){
    	return [
			[ 'url'=>'https://laravel.com/docs' , 'name' =>'Docs'],
			[ 'url'=>'https://laracasts.com' ,'name'=>'Laracasts'],
			[ 'url'=>'https://laravel-news.com' , 'name' =>'News'],
			[ 'url'=>'https://blog.laravel.com' , 'name' =>'Blog'],
			[ 'url'=>'https://nova.laravel.com' , 'name' =>'Nova'],
			[ 'url'=>'https://forge.laravel.com' , 'name' =>'Forge'],
			[ 'url'=>'https://github.com/laravel/laravel' , 'name' =>'GitHub']
    	];
    }
}